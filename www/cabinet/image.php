<?php

switch (readValue("action")) {
	case "data" :
		$arrImageRender = Array();

		if (readValue("format") == "png" || readValue("format") == "gif" || readValue("format") == "jpg") {
			$arrImageRender['format'] = readValue("format");
		} else {
			$arrImageRender['format'] = "png";
		}

		if (readValue("monochrome") == "true" || readValue("monochrome") == "false") {
			$arrImageRender['monochrome'] = readValue("monochrome");
		} else {
			$arrImageRender['monochrome'] = "true";
		}

		if (readValue("transparent") == "true" || readValue("transparent") == "false") {
			$arrImageRender['transparent'] = readValue("transparent");
		} else {
			$arrImageRender['transparent'] = "true";
		}

		if (readValueNum("resize") > 0 && readValueNum("resize") <= 1024) {
			$arrImageRender['resize'] = readValueNum("resize");
		} else {
			$arrImageRender['resize'] = "794";
		}

		if (readValueNum("colors") >= 0 && readValueNum("colors") <= 1024) {
			$arrImageRender['colors'] = readValueNum("colors");
		} else {
			$arrImageRender['colors'] = "16";
		}

		$data = $objDB -> select("SELECT * FROM userImageRenderOptions WHERE userID=" . $objSession -> getUserID() . ";");
		if ($data) {
			if ($objDB -> update("userImageRenderOptions", $arrImageRender, Array("userID" => $objSession -> getUserID()))) {
				$objTheme -> success("{LANG_UPDATE_TRUE}");
				//Очитска кеша пользователя, для формирования всех втраниц заново.
				$arrDirs = scandir(USER_IMAGE_STORAGE . $objSession -> getUserPath());
				if (is_array($arrDirs)) {
					foreach ($arrDirs as $key => $val) {
						if (is_file(USER_IMAGE_STORAGE . $objSession -> getUserPath() . "/" . $val)) {
							unlink(USER_IMAGE_STORAGE . $objSession -> getUserPath() . "/" . $val);
						}
					}
				}
			} else {
				$objTheme -> error("{LANG_UPDATE_FALSE}");
			}
		} else {
			$arrImageRender['userID'] = $objSession -> getUserID();
			if ($objDB -> insert("userImageRenderOptions", $arrImageRender)) {
				$objTheme -> success("{LANG_ADD_TRUE}");
			} else {
				$objTheme -> error("{LANG_ADD_FALSE}");
			}
		}
		break;
	default :
		$objTheme -> define(Array("MAIN_CONTENT" => "imageRenderForm.tpl"));
		break;
}
?>
