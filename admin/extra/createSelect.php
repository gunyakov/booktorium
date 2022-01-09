<?php
function createSelect($selected = 0, $id = 0, $countBR = 0, $str = '') {
	$objDB = $GLOBALS['objDB'];
	$objTheme = $GLOBALS['objTheme'];
	$data = $objDB -> select("SELECT * FROM categoryList WHERE parentID=" . $id . ";");
	if ($data) {
		foreach ($data as $key => $val) {
			if ($val['ID'] == $selected) {
				$str .= $objTheme -> addDynamic("option.tpl", Array("label" => str_repeat("&nbsp;", $countBR) . $val['name'], "value" => $val['ID'], "selected" => "selected"));
			} else {
				$str .= $objTheme -> addDynamic("option.tpl", Array("label" => str_repeat("&nbsp;", $countBR) . $val['name'], "value" => $val['ID'], "selected" => ""));
			}
			$str = createSelect($selected, $val['ID'], $countBR + 3, $str);
		}
	}
	return $str;
}
?>