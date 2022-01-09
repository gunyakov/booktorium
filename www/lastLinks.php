<?php
require_once "initd.php";
$objTheme->assign(Array("MENU" => "", "TAG_CLOUD" => "", "SORT_OPTIONS" => "", "TITLE" => "{LANG_LINKS_LAST_VISIT}"));
if ($objSession -> getUserID()) {
	$data = $objDB -> select("SELECT userLinks.*, booksList.name, booksFileList.fileName from userLinks, booksList, booksFileList WHERE userLinks.userID=" . $objSession -> getUserID() . " AND userLinks.bookID=booksList.ID AND userLinks.fileID=booksFileList.ID ORDER BY userLinks.datePut DESC LIMIT 5;");
	if ($data) {
		$objTheme -> define(Array("MAIN_CONTENT" => "linksList.tpl"));
		$linksList = '';
		foreach ($data as $key => $val) {
			$linksList .= $objTheme -> addDynamic("linksListItem.tpl", $val);
		}
		$objTheme -> assign(Array("LINKS_CONTENT" => $linksList, "name" => "{LANG_LINKS_LAST_VISIT}"));
	}
	else {
		$objTheme -> warning("{LANG_HAVE_NO_ELEMENT}");
	}
} else {
	$objTheme -> warning("{LANG_LOGIN_FALSE}");
}
require_once "end.php";
?>