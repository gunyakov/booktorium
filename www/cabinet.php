<?php

require_once "initd.php";
require_once "extra/readValue.php";

$objTheme -> assign(Array("SORT_OPTIONS" => "", "TAG_CLOUD" => "", "MENU_NAME" => "{LANG_CABINET}"));

$arrModules = Array();
$arrModules['profile'] = "{LANG_PROFILE}";
$arrModules['link'] = "{LANG_LINKS_MANAGER}";
$arrModules['image'] = "{LANG_IMAGE_RENDER}";

$objTheme -> define(Array("MENU" => "menu.tpl"));

$module = readValue('mod');
if (!$module) {
	$module = "profile";
}
$strMenu = "";
foreach ($arrModules as $key => $val) {
	if ($module == $key) {
		$objTheme -> assign(Array("TITLE" => $val));
		$strMenu .= $objTheme -> addDynamic("menuItemActive.tpl", Array("name" => $val, "link" => "cabinet.php?mod=" . $key));
	} else {
		$strMenu .= $objTheme -> addDynamic("menuItem.tpl", Array("name" => $val, "link" => "cabinet.php?mod=" . $key));
	}
}
$objTheme -> assign(Array("MENU_CONTENT" => $strMenu));
if ($objSession -> getUserID()) {
	if (is_file("cabinet/" . $module . ".php")) {
		require_once "cabinet/" . $module . ".php";
	} else {
		require_once "cabinet/profile.php";
	}
} else {
	$objTheme -> error("{LANG_LOGIN_FALSE}");
}

require_once "end.php";
?>
