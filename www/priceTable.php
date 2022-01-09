<?php
require_once "initd.php";
$objTheme->assign(Array("MENU" => "", "TAG_CLOUD" => "", "SORT_OPTIONS" => "", "TITLE" => "{LANG_TITLE_PRICE_TABLE}"));
$objTheme -> define(Array("MAIN_CONTENT" => "priceTable.tpl"));
$data = $objDB->select("SELECT * FROM userOptions;");
if($data) {
	foreach($data as $key => $val) {
		$objTheme->assign(Array($val['name'] => $val['value']));
	}
}
require_once "end.php";
?>