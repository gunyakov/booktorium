<?php
require_once "initd.php";
require_once "extra/rating.php";
require_once "extra/getString.php";

function formatFileSize($fileSize) {
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

$objTheme -> assign(Array("MENU" => "", "TAG_CLOUD" => "", "SORT_OPTIONS" => ""));
$objTheme -> defineMain("index.php/index.tpl");
$sql = Array();
$sql['NEW_BOOK_CONTENT'] = "SELECT * FROM booksList WHERE approved = 'yes' ORDER BY datePut DESC, name ASC LIMIT " . MAIN_PAGE_SLIDER_BOOKS . ";";
$sql['TOP_READ_CONTENT'] = "SELECT * FROM booksList WHERE approved = 'yes' ORDER BY readCount DESC, datePut DESC LIMIT " . MAIN_PAGE_RATING_BOOKS . ";";
$sql['TOP_COMMENT_CONTENT'] = "SELECT * FROM booksList WHERE approved = 'yes' ORDER BY ratingCount DESC, datePut DESC LIMIT " . MAIN_PAGE_RATING_BOOKS . ";";
$sql['TOP_DOWNLOAD_CONTENT'] = "SELECT * FROM booksList WHERE approved = 'yes' ORDER BY downloadCount DESC, datePut DESC LIMIT " . MAIN_PAGE_RATING_BOOKS . ";";
$sql['TOP_RATING_CONTENT'] = "SELECT * FROM booksList WHERE approved = 'yes' ORDER BY rating DESC, datePut DESC LIMIT " . MAIN_PAGE_RATING_BOOKS. ";";
foreach ($sql as $sqlKey => $sqlVal) {
	$data = $objDB -> select($sqlVal);
	if($data) {
	//print_r($data);
	$list = "";
	$i = 1;
	if ($data) {
		foreach ($data as $key => $val) {
			$objBook = new Book($val['ID']);
			$bookInfo = $objBook -> getInfo();
			$bookInfo['rating'] = getRating($bookInfo['rating']);
			if ($sqlKey == "NEW_BOOK_CONTENT") {
				$bookInfo['smallDescr'] = getString($bookInfo['smallDescr'], MAIN_PAGE_SLIDER_TEXT_LENGTH);
				$list .= $objTheme -> addDynamic("index.php/ratingSliderItem.tpl", $bookInfo);
			} else {
				$list .= $objTheme -> addDynamic("index.php/topSliderItem" . $i . ".tpl", $bookInfo);
			}
			$i++;
			if ($i > 2) {
				$i = 1;
			}
		}
	}
	$objTheme -> assign(Array($sqlKey => $list));
	}
else {
echo($objDB->getError());
}
}

$data = $objDB -> select("SELECT COUNT(ID) FROM booksList WHERE approved = 'yes';");
$objTheme -> assign(Array("BOOKS_COUNT" => $data[0]['COUNT(ID)']));
$data = $objDB -> select("SELECT COUNT(ID) FROM authorList;");
$objTheme -> assign(Array("AUTHOR_COUNT" => $data[0]['COUNT(ID)']));
$data = $objDB -> select("SELECT COUNT(ID) FROM printList;");
$objTheme -> assign(Array("PRINT_COUNT" => $data[0]['COUNT(ID)']));
$data = $objDB -> select("SELECT SUM(booksFileList.fileSize) FROM booksFileList, booksList WHERE booksList.approved = 'yes' AND booksList.ID = booksFileList.bookID;");
$objTheme -> assign(Array("FILE_SIZE" => formatFileSize($data[0]['SUM(booksFileList.fileSize)'])));
require_once "end.php";
?>
