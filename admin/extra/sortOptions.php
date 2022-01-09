<?php
$arrFullOptions = Array();

$data = $objDB -> select("DESCRIBE booksList;");
if ($data) {
	foreach ($data as $key => $val) {
		$name = "";
		foreach ($val as $key2 => $val2) {
			if ($key2 == "Field") {
				$name = $val2;
			}
			if ($key2 == "Type" && $name != "approved") {
				if (substr($val2, 0, 4) == "enum") {
					$val2 = substr($val2, 5, strlen($val2) - 6);
					$val2 = str_replace("'", "", $val2);
					$val2 = explode(",", $val2);
					$arrOptions = Array();
					foreach ($val2 as $key3 => $val3) {
						$arrOptions[$val3] = $val3;
					}
					//echo($val2);
					$arrFullOptions[$name] = $arrOptions;
				}
			}
		}
	}
}
?>
