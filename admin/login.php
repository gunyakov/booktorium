<?php
require_once "initd.php";

if(@$_GET['action'] == 'logout') {
	$objSession -> Logout();
}

if (@$_POST['name'] && @$_POST['passw']) {
	$objTheme -> defineMain("htmp.tpl");
	if ($objSession -> Login($_POST['name'], $_POST['passw'])) {
		$objTheme -> success("{LANG_LOGIN_TRUE}");
	} else {
		$objTheme -> error("{LANG_LOGIN_FALSE}");
	}
} else {
	$objTheme -> defineMain("loginForm.tpl");
}
require_once "end.php";
?>
