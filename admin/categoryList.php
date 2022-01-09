<?php

require_once "initd.php";

require_once "extra/readValue.php";
require_once "extra/createSelect.php";

if (readValueNum("id")) {
	$data = $objDB -> select("SELECT * FROM categoryList WHERE ID =" . readValue("id") . ";");
	if ($data) {
		switch(readValue("action")) {
			case "fixProblem" :
				$errorList = "";

				$dataCategory = $objDB -> select("SELECT * FROM booksCategoryList WHERE categoryID = " . readValue("id") . ";");
				if ($dataCategory) {
					foreach ($dataCategory as $key => $val) {
						if (!$objDB -> select("SELECT * FROM booksList WHERE ID = " . $val['bookID'] . ";")) {
							if ($objDB -> delete("booksCategoryList", Array("ID" => $val["ID"]))) {
								$errorList .= $objTheme -> addDynamic("liTrue.tpl", Array("LI_CONTENT" => "{LANG_BOOK_LINK_EMPTY}, {LANG_FIXED_TRUE}"));
							} else {
								$errorList .= $objTheme -> addDynamic("liTrue.tpl", Array("LI_CONTENT" => "{LANG_BOOK_LINK_EMPTY}, {LANG_FIXED_FALSE}"));
							}
						}
					}
				} else {
					$errorList .= $objTheme -> addDynamic("liFalse.tpl", Array("LI_CONTENT" => "{LANG_LIST_EMPTY}"));
				}
				
				$dataCategory = $objDB -> select("SELECT COUNT(ID) FROM booksCategoryList WHERE categoryID = " . readValue("id") . ";");
				
				if ($dataCategory[0]['COUNT(ID)'] != $data[0]["bookCount"]) {
					if ($objDB -> update("categoryList", Array("bookCount" => $dataCategory[0]['COUNT(ID)']), Array("ID" => readValue("id")))) {
						$errorList .= $objTheme -> addDynamic("liTrue.tpl", Array("LI_CONTENT" => "{LANG_COUNT_NOT_SAME}, {LANG_FIXED_TRUE}"));
					} else {
						$errorList .= $objTheme -> addDynamic("liTrue.tpl", Array("LI_CONTENT" => "{LANG_COUNT_NOT_SAME}, {LANG_FIXED_FALSE}"));
					}
				}
				if (!empty($errorList)) {
					$objTheme -> warning($errorList);
				} else {
					$objTheme -> success("{LANG_ERROR_LINE_EMPTY}");
				}
				break;
			case "delCategory" :
				$dataCategory = $objDB -> select("SELECT * FROM categoryList WHERE parentID = " . readValue("id") . ";");
				if (!$dataCategory && $data[0]['bookCount'] == 0) {
					if ($objDB -> delete("categoryList", Array("ID" => readValue("id")))) {
						$objTheme -> success("{LANG_DEL_TRUE}");
					} else {
						$objTheme -> error("{LANG_DEL_FALSE}");
					}
				} else {
					$objTheme -> warning("{LANG_CATEGORY_NO_EMPTY}");
				}
				break;

			case "updateCategory" :
				if (readValue("name") && readValueNum("id") > 0 && readValue("descr")) {
					$data = $objDB -> select("SELECT * FROM categoryList WHERE ID = " . readValue("parentID") . ";");
					if ($data || readValue("parentID") == 0) {
						$arrData = Array();
						$arrData['name'] = readValue("name");
						$arrData['parentID'] = readValueNum("parentID");
						
						if($arrData['parentID'] < 1 ) {
							$arrData['parentID'] = 0;
						}
						$arrData['descr'] = readValue("descr");
						
						if ($objDB -> update("categoryList", $arrData, Array("ID" => readValue("id")))) {
							$objTheme -> success("{LANG_UPDATE_TRUE}");
						} else {
							$objTheme -> error("{LANG_UPDATE_FALSE}");
						}
					} else {
						$objTheme -> warning("{LANG_CATEGORY_LINE_EMPTY}");
					}
				} else {
					$objTheme -> warning("{LANG_ERROR_READ_FORM}");
				}
				break;
			default :
				$objTheme -> define(Array("MAIN_CONTENT" => "categoryForm.tpl"));
				$objTheme -> assign($data[0]);
				$objTheme -> assign(Array("SELECT_CATEGORY_CONTENT" => createSelect($data[0]['parentID'])));
		}
	} else {
		$objTheme -> warning("{LANG_LINE_EMPTY}");
	}
} else {
	$data = $objDB -> select("SELECT * FROM categoryList;");
	if ($data) {
		$objTheme -> define(Array("MAIN_CONTENT" => "table.tpl", "TH_CONTENT" => "thCategoryList.tpl"));
		$objTheme -> assign(Array("TABLE_TITLE" => "{LANG_CATEGORY_LIST_TITLE}"));
		$listA = "";
		foreach ($data as $key => $val) {
			$listA .= $objTheme -> addDynamic("trCategoryList.tpl", $val);
		}
		$objTheme -> assign(Array("TBODY_CONTENT" => $listA));
	} else {
		$objTheme -> warning("{LANG_HAVE_NO_ELEMENT}");
	}
}

require_once "end.php";
?>
