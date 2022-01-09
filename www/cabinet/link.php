<?php
//Переключаем события
switch(readValue("action")) {
	//------------------------------------------------------------------------------------------------------------
	//Если событие: "Удалить все закладки к книге"
	//------------------------------------------------------------------------------------------------------------
	case "delBook" :
		if (readValueNum("id")) {
			$data = $objDB -> select("SELECT * FROM userLinks WHERE bookID = " . readValue("id") . " AND userID = " . $objSession -> getUserID() . ";");
			if ($data) {
				if ($objDB -> delete("userLinks", array("bookID" => readValue("id"), "userID" => $objSession -> getUserID()))) {
					$objTheme -> success("{LANG_DEL_TRUE}");
				} else {
					$objTheme -> error("{LANG_DEL_TRUE}");
				}
			} else {
				$objTheme -> warning("{LANG_ERROR_READ_CONTENT}");
			}
		} else {
			$objTheme -> warning("{LANG_ERROR_READ_FORM}");
		}
		break;
	//------------------------------------------------------------------------------------------------------------
	//Если событие: "Удалить текущую закладку"
	//------------------------------------------------------------------------------------------------------------
	case 'delLink' :
		if (readValue("id")) {
			$data = $objDB -> select("SELECT bookID FROM userLinks WHERE ID=" . readValue("id") . " AND userID=" . $objSession -> getUserID() . ";");
			if ($data) {
				if ($objDB -> delete("userLinks", Array("userID" => $objSession -> getUserID(), "ID" => readValue("id")))) {
					$objTheme -> success("{LANG_DEL_TRUE}");
				} else {
					$objTheme -> error("{LANG_DEL_FALSE}");
				}
			} else {
				$objTheme -> warning("{LANG_ERROR_READ_CONTENT}");
			}
		} else {
			$objTheme -> warning("{LANG_ERROR_READ_FORM}");
		}
		break;
	//------------------------------------------------------------------------------------------------------------
	//Если событие: "Просмотр закладок книги"
	//------------------------------------------------------------------------------------------------------------
	case "view" :
		if (readValueNum("id")) {
			$data = $objDB -> select("SELECT userLinks.*, booksList.name, booksFileList.fileName from userLinks, booksList, booksFileList WHERE userLinks.bookID=" . readValue("id") . " AND userLinks.userID=" . $objSession -> getUserID() . " AND userLinks.bookID = booksList.ID AND userLinks.fileID = booksFileList.ID ORDER BY userLinks.pageNum ASC;");
			if ($data) {
				$objTheme -> define(Array("MAIN_CONTENT" => "linksList.tpl"));
				$linksList = '';
				foreach ($data as $key => $val) {
					$linksList .= $objTheme -> addDynamic("linksListItemShort.tpl", $val);
				}
				$objTheme -> assign(Array("LINKS_CONTENT" => $linksList, "name" => $val['name']));
			} else {

				$objTheme -> error("{LANG_ERROR_READ_CONTENT}");
			}
		} else {
			$objTheme -> warning("{LANG_ERROR_READ_FORM}");
		}
		break;
	//------------------------------------------------------------------------------------------------------------
	//Если событие не определенно
	//------------------------------------------------------------------------------------------------------------
	default :
		//Выбираем список книг, к которым есть закладки
		$data = $objDB -> select("SELECT userLinks.*, userLinks.bookID AS ID, booksList.name, booksFileList.fileName from userLinks, booksList, booksFileList WHERE userLinks.userID=" . $objSession -> getUserID() . " AND userLinks.bookID = booksList.ID AND userLinks.fileID = booksFileList.ID GROUP BY userLinks.bookID;");
		//Если список существует
		if ($data) {
			//Устанавливаем опции шаблона
			$objTheme -> define(Array("MAIN_CONTENT" => "links.tpl"));
			//Сбрасываем список закладок
			$links = "";
			//Проходим по списку
			foreach ($data as $key => $val) {
				//Формируем список закладок
				$count = $objDB -> select("SELECT count(ID) as count FROM userLinks WHERE userID=" . $objSession -> getUserID() . " AND bookID=" . $val['ID'] . ";");
				$val['count'] = $count[0]['count'];
				$links .= $objTheme -> addDynamic("linksListBook.tpl", $val);
			}
			//Выводим список закладок в шаблон
			$objTheme -> assign(Array("LINKS_CONTENT" => $links));
		}
		//Если списка закладок не существует 
		else {
			//Выводим сообщение об этом
			$objTheme -> warning("{LANG_HAVE_NO_ELEMENT}");
		}
		break;
}
?>