<?php

require_once "initd.php";

require_once "extra/readValue.php";
require_once "extra/formatFileSize.php";
require_once "extra/sortOptions.php";

if (readValueNum("id")) {
	$data = $objDB -> select("SELECT * FROM booksList WHERE ID = " . readValue("id") . ";");
	if ($data) {
		switch(readValue("action")) {
			case "putToList" :
				if ($objDB -> update("booksList", Array("approved" => "list", "datePut" => "NOW()"), Array("ID" => readValue("id")))) {
					$objTheme -> success("{LANG_UPDATE_TRUE}");
					$objDB -> select("UPDATE user SET amount = amount + " . APROVED_BOOK_AMOUNT . " WHERE ID=" . $data[0]['userID'] . ";");
				} else {
					$objTheme -> error("{LANG_UPDATE_FALSE}");
				}
				break;
			case "approved" :
				if ($objDB -> update("booksList", Array("approved" => "yes", "datePut" => "NOW()"), Array("ID" => readValue("id")))) {
					$objTheme -> success("{LANG_UPDATE_TRUE}");
					$objDB -> select("UPDATE user SET amount = amount + " . APROVED_BOOK_AMOUNT . " WHERE ID=" . $data[0]['userID'] . ";");
				} else {
					$objTheme -> error("{LANG_UPDATE_FALSE}");
				}
				break;
			case "returnToEdit" :
				if ($objDB -> update("booksList", Array("approved" => "no"), Array("ID" => readValue("id")))) {
					$objTheme -> success("{LANG_UPDATE_TRUE}");
				} else {
					$objTheme -> error("{LANG_UPDATE_FALSE}");
				}
				break;
			default :
				$objTheme -> define(Array("MAIN_CONTENT" => "bookForm.tpl"));
				$bookData = $data[0];
				$objTheme -> assign($data[0]);

				$data = $objDB -> select("SELECT authorList.* FROM authorList, booksAuthorList WHERE booksAuthorList.bookID = " . readValue("id") . " AND booksAuthorList.authorID = authorList.ID;");
				if ($data) {
					$listA = "";
					foreach ($data as $key => $val) {
						$listA .= $objTheme -> addDynamic("p.tpl", Array("P_CONTENT" => $val['familyName'] . " " . $val['name']));
					}
					$objTheme -> assign(Array("AUTHOR_CONTENT" => $listA));
				} else {
					$objTheme -> assign(Array("AUTHOR_CONTENT" => $objTheme -> addDynamic("warning.tpl", Array("WARNING_CONTENT" => "{LANG_HAVE_NO_ELEMENT}"))));
				}

				$data = $objDB -> select("SELECT categoryList.* FROM categoryList, booksCategoryList WHERE booksCategoryList.bookID = " . readValue("id") . " AND booksCategoryList.categoryID = categoryList.ID;");
				if ($data) {
					$listA = "";
					foreach ($data as $key => $val) {
						$parentData = $objDB -> select("SELECT * FROM categoryList WHERE ID=" . $val['parentID'] . ";");
						if ($parentData) {
							$listA .= $objTheme -> addDynamic("p.tpl", Array("P_CONTENT" => $parentData[0]['name'] . " -> " . $val['name']));
						} else {
							$listA .= $objTheme -> addDynamic("p.tpl", Array("P_CONTENT" => $val['name']));
						}

					}
					$objTheme -> assign(Array("CATEGORY_CONTENT" => $listA));
				} else {
					$objTheme -> assign(Array("CATEGORY_CONTENT" => $objTheme -> addDynamic("warning.tpl", Array("WARNING_CONTENT" => "{LANG_HAVE_NO_ELEMENT}"))));
				}

				$data = $objDB -> select("SELECT printList.* FROM printList, booksPrintList WHERE booksPrintList.bookID = " . readValue("id") . " AND booksPrintList.printID = printList.ID;");
				if ($data) {
					$listA = "";
					foreach ($data as $key => $val) {
						$listA .= $objTheme -> addDynamic("p.tpl", Array("P_CONTENT" => $val['name'] . ", " . $val['city']));
					}
					$objTheme -> assign(Array("PRINT_CONTENT" => $listA));
				} else {
					$objTheme -> assign(Array("PRINT_CONTENT" => $objTheme -> addDynamic("warning.tpl", Array("WARNING_CONTENT" => "{LANG_HAVE_NO_ELEMENT}"))));
				}

				$data = $objDB -> select("SELECT * FROM booksFileList WHERE bookID = " . readValue("id") . ";");
				if ($data) {
					$listA = "";
					foreach ($data as $key => $val) {
						$listA .= $objTheme -> addDynamic("p.tpl", Array("P_CONTENT" => $val['fileName'] . ", " . formatFileSize($val['fileSize'])));
					}
					$objTheme -> assign(Array("FILE_CONTENT" => $listA));
				} else {
					$objTheme -> assign(Array("FILE_CONTENT" => $objTheme -> addDynamic("warning.tpl", Array("WARNING_CONTENT" => "{LANG_HAVE_NO_ELEMENT}"))));
				}

				$data = $objDB -> select("SELECT *, CONCAT('" . IMAGES_DOWNLOAD_LINK . "', storage, '/', imageName) as imageName FROM booksImageList WHERE bookID=" . readValue("id") . " ORDER BY orderID ASC;");
				if ($data) {
					$listA = "";
					foreach ($data as $key => $val) {
						$listA .= $objTheme -> addDynamic("pImage.tpl", Array("P_CONTENT" => $val['imageName']));
					}
					$objTheme -> assign(Array("IMAGE_CONTENT" => $listA));
				} else {
					$objTheme -> assign(Array("IMAGE_CONTENT" => $objTheme -> addDynamic("warning.tpl", Array("WARNING_CONTENT" => "{LANG_HAVE_NO_ELEMENT}"))));
				}
				//------------------------------------------------------------------------------------------------------------
				//Вывод в браузер эктра данных
				//------------------------------------------------------------------------------------------------------------
				if (is_array($arrFullOptions)) {
					//Формируем списки опций
					$extraBlocksContent = '';
					foreach ($arrFullOptions as $key => $val) {
						$extraBlocksContent .= $objTheme -> addDynamic("p.tpl", Array("P_CONTENT" => "{TXT_KEY_" . strtoupper($key) . "} => {TXT_KEY_".strtoupper($bookData[$key])."}"));
					}
					$objTheme -> assign(Array("EXTRA_BLOCKS_CONTENT" => $extraBlocksContent));
				} else {
					$objTheme -> assign(Array("EXTRA_BLOCKS_CONTENT" => ""));
				}
		}
	} else {
		$objTheme -> warning("{LANG_HAVE_NO_ELEMENT}");
	}
} else {
	if (readValue("show") == "all") {
		$data = $objDB -> select("SELECT booksList.*, user.name as userName FROM booksList, user WHERE booksList.userID = user.ID;");
	} else {
		$data = $objDB -> select("SELECT booksList.*, user.name as userName FROM booksList, user WHERE booksList.approved = 'finish' AND booksList.userID = user.ID;");
	}
	if ($data) {
		$objTheme -> define(Array("MAIN_CONTENT" => "table.tpl", "TH_CONTENT" => "thBookList.tpl"));
		$listA = "";
		foreach ($data as $key => $val) {
			$listA .= $objTheme -> addDynamic("trBookList.tpl", $val);
		}
		$objTheme -> assign(Array("TABLE_TITLE" => "{LANG_BOOK_LIST_TITLE}", "TBODY_CONTENT" => $listA));
	} else {
		$objTheme -> warning("{LANG_HAVE_NO_ELEMENT}");
	}
}

require_once "end.php";
?>
