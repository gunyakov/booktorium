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

function delTiket($tiketID) {
	$objDB = $GLOBALS['objDB'];
	$objSession = $GLOBALS['objSession'];
	$arrTiket = $objDB -> select("SELECT * FROM tiket WHERE ID = " . $tiketID . " AND userID = " . $objSession -> getUserID() . ";");
	if ($arrTiket) {
		$objDB -> select("DELETE FROM tiket WHERE ID = " . $tiketID);
		if ($arrTiket[0]['parentID'] != 0) {
			delTiket($arrTiket[0]['parentID']);
		}
	}
}
?>