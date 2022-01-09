<?php
require_once "initd.php";
require_once "extra/readValue.php";

$objTheme -> assign(Array("TAG_CLOUD" => "", "SORT_OPTIONS" => "", "TITLE" => "{LANG_LINKS_ADD}"));
if ($objSession -> getUserID()) {
	if (readValueNum("id") && readValueNum("page") && readValueNum("file")) {
		$bookID = readValue('id');
		$pageNum = readValue('page');
		$fileID = readValue('file');
		$objTheme -> define(Array("MENU" => "menu.tpl"));
		$objTheme -> assign(Array("MENU_NAME" => "{LANG_MORE}", "MENU_CONTENT" => $objTheme -> addDynamic("menuItem.tpl", Array("link" => "read.php?id=" . $bookID . "&page=" . $pageNum . "&file=" . $fileID, "name" => "{LANG_BACK}"))));
		$objBook = new Book($bookID);
		if ($objBook -> is_book()) {
			$data = $objDB -> select("SELECT * FROM booksFileList WHERE bookID=" . $bookID . " AND ID=" . $fileID . ";");
			if ($data) {
				$data = $data[0];
				if ($pageNum <= $data['pages'] && $pageNum > 0) {
					$data = $objDB -> select("SELECT * FROM userLinks WHERE userID=" . $objSession -> getUserID() . " AND bookID=" . $bookID . " AND pageNum=" . $pageNum . " AND fileID=" . $fileID . ";");
					if (!$data) {
						if ($objDB -> insert("userLinks", Array("userID" => $objSession -> getUserID(), "bookID" => $bookID, "pageNum" => $pageNum, "datePut" => "NOW()", "fileID" => $fileID))) {
							$objTheme -> success("{LANG_ADD_TRUE}");
						} else {
							$objTheme -> error("{LANG_ADD_FALSE}");
						}
					} else {
						$objTheme -> warning("{LANG_LINKS_HAVE_YET}");
					}
				} else {
					$objTheme -> warning("{LANG_LINKS_ADD_ERROR_PAGE}");
				}
			} else {
				$objTheme -> warning("{LANG_LINKS_ADD_ERROR_PAGE}");
			}
		}
		//Если книга не существует
		else {
			$objTheme -> warning("{LANG_ERROR_READ_CONTENT}");
		}
	}
	//Если книга имеет не цифровой формат
	else {
		$objTheme -> warning("{LANG_ERROR_READ_FORM}");
	}
} else {
	$objTheme -> warning("{LANG_LOGIN_FALSE}");
	$objTheme -> assign(Array("MENU" => ""));
}
require_once "end.php";
?>
