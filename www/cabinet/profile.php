<?php
switch(@$_POST['action']) {
	case "data" :
		$data = Array();
		$data['name'] = @$_POST['name'];
		$data['email'] = @$_POST['email'];

		if ($objDB -> update("user", $data, Array("ID" => $objSession -> getUserID()))) {
			$objTheme -> define(Array("MAIN_CONTENT" => "messages/success.tpl"));
			$objTheme -> assign(Array("SUCCESS_CONTENT" => "{LANG_UPDATE_TRUE}"));
		} else {
			$objTheme -> define(Array("MAIN_CONTENT" => "messages/error.tpl"));
			$objTheme -> assign(Array("ERROR_CONTENT" => "{LANG_UPDATE_FALSE}"));
		}
		break;

	case "password" :
		$passw = @$_POST['passw'];
		$newPassw = @$_POST['new_passw'];
		$newPassw2 = @$_POST['reenter_passw'];
		if (!$passw || !$newPassw || !$newPassw2) {
			$objTheme -> define(Array("MAIN_CONTENT" => "messages/error.tpl"));
			$objTheme -> assign(Array("ERROR_CONTENT" => "{LANG_PASSWORD_NO_ENTER}"));
		} else {
			if ($objSession -> getUserPassw() == md5($passw)) {
				if ($newPassw == $newPassw2) {
					if ($objDB -> update("user", Array("passw" => md5($newPassw)), Array("ID" => $objSession -> getUserID()))) {
						$objTheme -> define(Array("MAIN_CONTENT" => "messages/success.tpl"));
						$objTheme -> assign(Array("SUCCESS_CONTENT" => "{LANG_UPDATE_TRUE}"));
					} else {
						$objTheme -> define(Array("MAIN_CONTENT" => "messages/error.tpl"));
						$objTheme -> assign(Array("ERROR_CONTENT" => "{LANG_UPDATE_FALSE}"));
					}
				} else {
					$objTheme -> define(Array("MAIN_CONTENT" => "messages/error.tpl"));
					$objTheme -> assign(Array("ERROR_CONTENT" => "{LANG_PASSWORD_NOT_SAME}"));
				}
			} else {
				$objTheme -> define(Array("MAIN_CONTENT" => "messages/error.tpl"));
				$objTheme -> assign(Array("ERROR_CONTENT" => "{LANG_PASSWORD_OLD_NOT_SAME}"));
			}
		}
		break;

	default :
		$objTheme -> define(Array("MAIN_CONTENT" => "profile.tpl"));
		$data = $objDB -> select("SELECT * FROM user WHERE ID=" . $objSession -> getUserID() . ";");
		$objTheme -> assign($data[0]);
		$data = $objDB -> select("SELECT * FROM userOptions WHERE userID=" . $objSession -> getUserID() . ";");
		foreach ($data as $key => $val) {
			$objTheme -> assign(Array($val['name'] => $val['value']));
			$val['name'] = str_replace("CurrentCount", "", $val['name']);
			$objTheme -> assign(Array("Limit".$val['name'] => $objOptions -> getOption("Limit".$val['name'])));
			$objTheme -> assign(Array("Amount".$val['name'] => $objOptions -> getOption("Amount".$val['name'])));
			$objTheme -> assign(Array("Count".$val['name'] => $objOptions -> getOption("Count".$val['name'])));
		}
		break;
}
?>