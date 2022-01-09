<?php
class Book {
	private $bookID;
	private $bookInfo;
	private $imageList;
	private $fileList;
	private $totalFileSize;
	private $is_book;

	function __construct($bookID) {
		$objDB = $GLOBALS['objDB'];
		$this -> bookID = $bookID;
		if (is_numeric($bookID)) {
			$data = $objDB -> select("SELECT * FROM booksList WHERE ID=" . $bookID . ";");
			if ($data && @$data[0]['approved'] == 'yes') {
				$this -> bookInfo = $data[0];

				$data = $objDB -> select("SELECT *, CONCAT('" . IMAGES_DOWNLOAD_LINK . "', storage, '/', imageName) as imageName FROM booksImageList WHERE bookID=" . $bookID . " ORDER BY orderID ASC;");
				$this -> imageList = Array();
				if ($data) {
					$this -> imageList = $data;
					$this -> bookInfo['imageName'] = $data[0]['imageName'];
				} else {
					$this -> imageList[1]['imageName'] = IMAGES_DOWNLOAD_LINK . "default.png";
					$this -> imageList[1]['orderID'] = 0;
					$this -> bookInfo['imageName'] = IMAGES_DOWNLOAD_LINK . "default.png";
				}

				$data = $objDB -> select("SELECT printList.* FROM printList, booksPrintList WHERE booksPrintList.bookID=" . $bookID . " AND booksPrintList.printID = printList.ID;");
				if ($data) {
					$this -> bookInfo['printName'] = $data[0]['name'];
					$this -> bookInfo['city'] = $data[0]['city'];
				} else {
					$this -> bookInfo['printName'] = "{LANG_NO_DEFINE}";
					$this -> bookInfo['city'] = "{LANG_NO_DEFINE}";
				}

				$data = $objDB -> select("SELECT SUM(fileSize) FROM booksFileList WHERE bookID = " . $bookID . ";");
				$this -> bookInfo['fileSize'] = $this -> formatFileSize($data[0]['SUM(fileSize)']);

				$data = $objDB -> select("SELECT COUNT(*) FROM booksMessages WHERE bookID = " . $bookID . ";");
				$this -> bookInfo['reviewCount'] = $data[0]['COUNT(*)'];
				$this -> bookInfo['descr'] = trim($this -> bookInfo['descr']);
				if (empty($this -> bookInfo['descr'])) {
					$this -> bookInfo['descr'] = "{LANG_NO_BOOK_DESCR}";
				}
				$this -> is_book = true;
			} else {
				$this -> is_book = false;
			}
		} else {
			$this -> is_book = false;
		}
	}

	public function is_book() {
		return $this -> is_book;
	}

	public function getInfo() {
		if ($this -> is_book == true) {
			return $this -> bookInfo;
		} else {
			return false;
		}

	}

	public function getImages() {
		return $this -> imageList;
	}

	public function getFiles() {
		//Если у пользователя закончился Amount и Amount разрешен
		if (Limits("GetFiles")) {
			//Возвращаем ошибку
			return false;
		}
		//Если у пользователя не закончился Amount либо Amount отключен
		else {
			$objDB = $GLOBALS['objDB'];
			//Получаем список файлов к книге
			$data = $objDB -> select("SELECT * FROM booksFileList WHERE bookID = " . $this -> bookID . ";");
			//Инициализируем массив файлов
			$this -> fileList = Array();
			//Если файлы прикреплены к книге
			if ($data) {
				//Получаем название папки пользователя, для манипулирования файлами
				$pathRandom = $GLOBALS['objSession'] -> getUserPath();
				//Проходим по списку файлов
				foreach ($data as $key => $val) {
					$this -> fileList[$val['fileName']] = $val;
					//Если файл локальный
					if ($val['storage'] > 0) {
						//Если разрешена загрузка файлов по прямой ссылке
						if (FILES_DIRECT_LINK) {
							//Формируем ссылку на файл
							$this -> fileList[$val['fileName']]['link'] = FILES_DOWNLOAD_LINK . $val['storage'] . "/" . $val['fileName'];
						}
						//Если загрузка файлов идет через SymLink
						else {
							//Если не существует папка пользователя
							if (!is_dir(FILES_SIMLINK_STORAGE . $pathRandom)) {
								//Создаем папку
								mkdir(FILES_SIMLINK_STORAGE . $pathRandom, MKDIR_MODE);
							}
							//Если SymLink еще не создана для данного пользователя на текущий файл
							if (!is_file(FILES_SIMLINK_STORAGE . $pathRandom . "/" . $val['fileName'])) {
								//Создаем SymLink на текущий файл
								symlink(FILES_STORAGE . $val['storage'] . "/" . $val['fileName'], FILES_SIMLINK_STORAGE . $pathRandom . "/" . $val['fileName']);
							}
							//Формируем ссылку на файл
							$this -> fileList[$val['fileName']]['link'] = FILES_DOWNLOAD_LINK . $pathRandom . "/" . $val['fileName'];
						}
					}
					//Если файл удаленный
					else {
						//Формируем ссылку на файл
						$this -> fileList[$val['fileName']]['link'] = $val['fileName'];
					}
					//Устанавливаем некоторые значения списка файлов
					$this -> fileList[$val['fileName']]['name'] = $val['fileName'];
					$this -> fileList[$val['fileName']]['size'] = $this -> formatFileSize($val['fileSize']);
				}
				$objDB -> select("UPDATE booksList SET downloadCount = downloadCount + 1 WHERE ID = " . $this -> bookID . ";");
				Amount("GetFiles");
			} else {
				$this -> fileList["default.png"] = FILES_DOWNLOAD_LINK . "/default.png";
			}
			//Возвращаем список файлов
			return $this -> fileList;
		}

	}

	//-----------------------------------------------------------------------------------------------------------
	//Список файлов, привязаных к книге
	//-----------------------------------------------------------------------------------------------------------
	public function getFilesList() {
		$objDB = $GLOBALS['objDB'];
		$data = $objDB -> select("SELECT * FROM booksFileList WHERE bookID = " . $this -> bookID . ";");
		$fileList = Array();
		if ($data) {
			$fileList = $data;
		} else {
			$fileList[0]['name'] = "default.png";
			$fileList[0]['storage'] = 0;
		}
		return $fileList;
	}

	public function getCategory() {
		$objDB = $GLOBALS['objDB'];
		$data = $objDB -> select("SELECT categoryList.name, categoryList.ID FROM categoryList, booksCategoryList WHERE booksCategoryList.bookID=" . $this -> bookID . " AND booksCategoryList.categoryID=categoryList.ID;");
		if ($data) {
			foreach ($data as $key => $val) {
				$data[$key]['name'] = $val['name'];
			}
			return $data;
		} else {
			return false;
		}
	}

	public function getAuthor() {
		$objDB = $GLOBALS['objDB'];
		$data = $objDB -> select("SELECT CONCAT(authorList.familyName, ' ', authorList.name) AS name, authorList.ID FROM authorList, booksAuthorList WHERE booksAuthorList.bookID=" . $this -> bookID . " AND booksAuthorList.authorID=authorList.ID;");
		if ($data) {
			return $data;
		} else {
			return false;
		}
	}

	public function getTags() {
		$data = Array();
		if ($this -> getAuthor()) {
			$data = $this -> getAuthor();
		}
		if ($this -> getCategory()) {
			$data = $this -> getCategory();
		}
		if ($this -> getAuthor() && $this -> getCategory()) {
			$data = array_merge_recursive($this -> getCategory(), $this -> getAuthor());
		}

		$data['format']['name'] = $this -> bookInfo['format'];
		$data['name']['name'] = $this -> bookInfo['name'];
		return $data;
	}

	private function formatFileSize($fileSize) {
		switch($fileSize) {
			case $fileSize > (1024 * 1024) :
				$fileSize = round($fileSize / (1024 * 1024), 2) . " MB";
				break;
			case $fileSize < (1024 * 1024) :
				$fileSize = round($fileSize / 1024) . " KB";
				break;
		}
		return $fileSize;
	}

}
?>
