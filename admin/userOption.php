<?php

require_once "initd.php";
require_once "extra/readValue.php";
$userID = readValueNum("id");

if ($userID) {
	$data = $objDB -> select("SELECT * FROM user WHERE ID=" . $userID . ";");
	if ($data) {
		$data = $data[0];
		$arrOption = Array();
		$arrOption['CommentsPost'] = Array();
		$arrOption['ReadImage'] = Array();
		$arrOption['ReadText'] = Array();
		$arrOption['GetFiles'] = Array();
		$arrOption['Login'] = Array();
		$arrOption['GetFullTIFF'] = Array();
		$arrOption['Search'] = Array();

		$arrAddOption = Array();
		$arrAddOption = $arrOption;

		$arrAddOption['AuthorAdd'] = "";
		$arrAddOption['AuthorEdit'] = "";
		$arrAddOption['AuthorEditAll'] = "";
		$arrAddOption['CommentsPostAntiBot'] = "";
		$arrAddOption['GetFilesAntiBot'] = "";
		$arrAddOption['CommentsShow'] = "";
		$arrAddOption['BookShow'] = "";
		$arrAddOption['BookRead'] = "";
		$arrAddOption['BookAdd'] = "";
		$arrAddOption['BookEdit'] = "";
		$arrAddOption['BookEditAll'] = "";
		$arrAddOption['PrintAdd'] = "";
		$arrAddOption['PrintEdit'] = "";
		$arrAddOption['PrintEditAll'] = "";

		$arrList = Array();
		$arrList['Limit'] = '';
		$arrList['CurrentCount'] = '';
		$arrList['Amount'] = '';
		$arrList['Count'] = '';

		switch(readValue("action")) {
			case "updateLimits" :
				$i = 0;
				foreach ($arrOption as $key => $val) {
					foreach ($arrList as $keyList => $valList) {
						if (@$_POST[$keyList . $key] != $objOptions -> getOptionByUser($keyList . $key, $userID) && is_numeric($_POST[$keyList . $key])) {
							if ($objOptions -> updateOption($keyList . $key, $_POST[$keyList . $key], $userID)) {
								$i++;
							} else {
								//Сообщаем об этом
								$error .= $objTheme -> addDynamic("liFalse.tpl", Array("LI_CONTENT" => "{LANG_UPDATE_FALSE} " . $keyList . $key));
							}
						}
					}
				}
				if (empty($error)) {
					if ($i == 0) {
						$objTheme -> warning("{LANG_OPTION_NOTHING_UPDATE}");
					} else {
						$objTheme -> success("{LANG_UPDATE_TRUE}, {LANG_OPTION_UPDATE}: " . $i);
					}
				} else {
					$objTheme -> error($error);
				}
				break;
			case "updateActions" :
				$error = '';
				$i = 0;
				foreach ($arrAddOption as $key => $val) {
					if (@$_POST[$key] == 'yes' || @$_POST[$key] == 'no') {
						if ($objOptions -> getOptionByUser($key, $userID) != $_POST[$key]) {
							if ($objOptions -> updateOption($key, $_POST[$key], $userID)) {
								$i++;
							} else {
								//Сообщаем об этом
								$error .= $objTheme -> addDynamic("liFalse.tpl", Array("LI_CONTENT" => "{LANG_UPDATE_FALSE} " . $key));
							}
						}
					}
				}
				if (empty($error)) {
					if ($i == 0) {
						$objTheme -> warning("{LANG_OPTION_NOTHING_UPDATE}");
					} else {
						$objTheme -> success("{LANG_UPDATE_TRUE}, {LANG_OPTION_UPDATE}: " . $i);
					}
				} else {
					$objTheme -> error($error);
				}
				break;
			case "resetCommentsPost" :
			case "resetReadImage" :
			case "resetReadText" :
			case "resetGetFiles" :
			case "resetLogin" :
			case "resetGetFullTIFF" :
			case "resetSearch" :
				foreach ($arrList as $key => $val) {
					if ($key != "CurrentCount") {
						$objDB -> delete("userOptions", Array("userID" => $userID, "name" => $key . substr($action, 5, strlen($action) - 5)));
					}
				}
				$objTheme -> success("{LANG_UPDATE_TRUE}");
				break;
			case "resetFull" :
				foreach ($arrOption as $key => $val) {
					foreach ($arrList as $keyList => $valList) {
						if ($keyList != "CurrentCount") {
							$objDB -> delete("userOptions", Array("userID" => $userID, "name" => $keyList . $key));
						}
					}
				}
				foreach ($arrAddOption as $key => $val) {
					$objDB -> delete("userOptions", Array("userID" => $userID, "name" => $key));
				}
				$objTheme -> success("{LANG_UPDATE_TRUE}");
				break;
			default :
				$objTheme -> define(Array("MAIN_CONTENT" => "userOption.tpl"));
				$objTheme -> assign($data);
				foreach ($arrOption as $key => $val) {
					foreach ($arrList as $keyList => $valList) {
						$arrOption[$key][$keyList . $key] = $objOptions -> getOptionByUser($keyList . $key, $userID);
						$objTheme -> assign(Array($keyList . $key => $arrOption[$key][$keyList . $key]));
					}
				}
				foreach ($arrAddOption as $key => $val) {
					$objTheme -> assign(Array("checked" . $key . "no" => "", "checked" . $key . "yes" => ""));
					$objTheme -> assign(Array("checked" . $key . $objOptions -> getOptionByUser($key, $userID) => "checked"));
				}
				break;
		}
	} else {
		$objTheme -> warning("{LANG_HAVE_NO_ELEMENT}");
	}
} else {
	$objTheme -> warning("{LANG_HAVE_NO_ELEMENT}");
}

require_once "end.php";
?>
