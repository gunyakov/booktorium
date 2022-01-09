<?php

require_once "initd.php";
require_once "extra/readValue.php";

switch(readValue("action")) {
	case "resetCounters" :
		$objDB -> select("UPDATE userOptions SET value=0 WHERE name LIKE 'CurrentCount%';");
		$objTheme -> success("{LANG_UPDATE_TRUE}");
		break;
	case "resetUserCounters" :
		if (readValueNum("id")) {
			if ($objDB -> select("SELECT * FROM user WHERE ID = " . readValue("id") . ";")) {
				$objDB -> select("UPDATE userOptions SET value=0 WHERE name LIKE 'CurrentCount%' AND userID = " . readValue("id") . ";");
				$objTheme -> success("{LANG_UPDATE_TRUE}");
			} else {
				$objTheme -> warning("{LANG_HAVE_NO_ELEMENT}");
			}
		} else {
			$objTheme -> warning("{LANG_ERROR_READ_FORM}");
		}
		break;
	default :
		$objTheme -> define(Array("MAIN_CONTENT" => "resetCounters.tpl"));
		break;
}
require_once "end.php";
?>
