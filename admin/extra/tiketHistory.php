<?php

function tiketHistory($id, $str = "") {
	$objDB = $GLOBALS['objDB'];
	$objTheme = $GLOBALS['objTheme'];
	$data = $objDB -> select("SELECT * FROM tiket WHERE ID=" . $id . ";");
	if ($data) {
		foreach ($data as $key => $val) {
			$str = $objTheme -> addDynamic("tiketP.tpl", $val) . $str;
			$str = tiketHistory($val['parentID'], $str);
		}
	}
	return $str;
}
