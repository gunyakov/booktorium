<?php

require_once "initd.php";

require_once "extra/readValue.php";

$objTheme -> assign(Array("TAG_CLOUD" => "", "MENU" => "", "SORT_OPTIONS" => "", "TITLE" => "{LANG_TITLE_GET_TIFF}"));
if ($objSession -> getUserID()) {
	if (readValueNum("id") && readValueNum("file") && readValueNum("page")) {
		if (!Limits("GetFullTIFF")) {
			$data = $objDB -> select("SELECT * FROM tiffImageList WHERE bookID = '" . readValue("id") . "' AND fileID ='" . readValue("file") . "' AND page = '" . readValue("page") . "' AND userID = " . $objSession -> getUserID() . ";");
			if ($data) {
				if (is_file(USER_IMAGE_STORAGE . $objSession -> getUserPath() . "/" . $data[0]['imageName'] . ".tiff")) {
					$objTheme -> define(Array("MAIN_CONTENT" => "getTiff.tpl"));
					$objTheme -> assign(Array("FULL_TIFF_PATH" => USER_IMAGE_DOWNLOAD_LINK . $objSession -> getUserPath() . "/" . $data[0]['imageName'] . ".tiff"));
					Amount("GetFullTIFF");
				} else {
					$objTheme -> warning("{LANG_ERROR_FORMAT_IMAGE}");
				}
			} else {
				$objTheme -> warning("{LANG_HAVE_NO_ELEMENT}");
			}
		} else {
			$objTheme -> error("{LANG_LIMIT_REACHED}");
		}
	} else {
		$objTheme -> warning("{LANG_ERROR_READ_FORM}");
	}
} else {
	$objTheme -> warning("{LANG_LOGIN_FALSE}");
}

require_once "end.php";
?>
