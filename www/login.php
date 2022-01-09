<?php
require_once "initd.php";
require_once "extra/readValue.php";

$objTheme -> assign(Array("TAG_CLOUD" => "", "SORT_OPTIONS" => "", "MENU" => "", "TITLE" => "{LANG_TITLE_LOGIN_FORM}"));
if(readValue("action") == 'logout') {
	$objSession -> Logout();
}
if (readValue("login") && readValue("passw")) {
	if ($objSession -> Login(readValue("login"), readValue("passw"))) {
		Amount("Login");
		$objTheme -> success("{LANG_LOGIN_TRUE}");
	} else {
		$objTheme -> error("{LANG_LOGIN_FALSE}");
	}
} else {
	$objTheme -> define(Array("MAIN_CONTENT" => "loginForm.tpl"));
}
require_once "end.php";
?>

