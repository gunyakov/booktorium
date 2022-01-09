<?php
include "initd.php";

$search = readValue('search');
if (!$search) {
	$search = readValue('s');
}
$objTheme -> assign(Array("TAG_CLOUD" => "", "MENU" => "", "SORT_OPTIONS" => "", "TITLE" => "{LANG_TITLE_SEARCH_FORM}"));
if ($objOptions -> getOption("Search") == "yes") {
	if ($search) {

		if (!Limits("Search")) {
			Amount("Search");
			//Убираем символы ' из строки для предотвращения взлома
			$search = str_replace("'", "", $search);
			switch(@$_POST['option']) {
				case "author" :
					$data = $objDB -> select("SELECT booksAuthorList.bookID FROM authorList, booksAuthorList WHERE authorList.familyName LIKE '%" . $search . "%' AND authorList.ID = booksAuthorList.authorID GROUP BY booksAuthorList.bookID LIMIT " . SEARCH_LIMIT . ";");
					break;
				case "name" :
					$data = $objDB -> select("SELECT ID as bookID FROM booksList WHERE name LIKE '%" . $search . "%' LIMIT " . SEARCH_LIMIT . ";");
					break;
				default :
					$data = $objDB -> select("SELECT ID as bookID FROM booksList WHERE descr LIKE '%" . $search . "%' OR smallDescr LIKE '%" . $search . "%' LIMIT " . SEARCH_LIMIT . ";");
					break;
			}

			if ($data) {
				$strMainContent = '';
				foreach ($data as $key => $val) {
					$objBook = new Book($val['bookID']);
					$bookInfo = $objBook -> getInfo();
					if ($bookInfo) {
						$strMainContent .= $objTheme -> addDynamic("showCategory.php/listItem.tpl", $bookInfo);
					}
				}
				$objTheme -> assign(Array("MAIN_CONTENT" => $strMainContent));
				if (SEARCH_SERVICE_MESSAGE) {
					$serviceMessage = true;
				}
			} else {
				$objTheme -> warning("{LANG_HAVE_NO_ELEMENT}");
			}
		} else {
			$objTheme -> error("{LANG_LIMIT_REACHED}");
		}

	} else {
		$objTheme -> define(Array("MAIN_CONTENT" => "searchForm.tpl"));
	}
} else {
	$objTheme -> warning("{LANG_PAGE_NO_SHOW}");
}
require_once "end.php";
?>