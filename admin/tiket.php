<?php

require_once "initd.php";

require_once "extra/readValue.php";
require_once "extra/tiketHistory.php";

if (readValueNum("id")) {
	$data = $objDB -> select("SELECT * FROM tiket WHERE ID = " . readValue("id") . ";");
	if ($data) {
		switch(readValue("action")) {
			case "answerTiket" :
				if (readValue("message") && readValue("subject")) {
					$arrTiket = Array();
					$arrTiket['subject'] = readValue("subject");
					$arrTiket['message'] = readValue("message");
					$arrTiket['parentID'] = readValueNum("id");
					$arrTiket['userID'] = $data[0]['userID'];
					$arrTiket['state'] = "answer";
					$arrTiket['datePut'] = "NOW()";
					
					if ($objDB -> insert("tiket", $arrTiket)) {
						$objTheme -> success("{LANG_ADD_TRUE}");
						$objDB -> update("tiket", Array("state" => "close"), Array("ID" => readValue("id")));
						$objDB -> update("tiket", Array("state" => "close"), Array("ID" => $data[0]['parentID']));
					} else {
						$objTheme -> error("{LANG_ADD_FALSE}");
					}
				} else {
					$objTheme -> warning("{LANG_ERROR_READ_FORM}");
				}
				break;
			default :
				$objTheme -> define(Array("MAIN_CONTENT" => "tiketForm.tpl"));
				$objTheme -> assign($data[0]);
				$objTheme -> assign(Array("TIKET_HISTORY" => tiketHistory(readValue('id'))));
		}
	} else {
		$objTheme -> warning("{LANG_HAVE_NO_ELEMENT}");
	}
} else {
	$data = $objDB -> select("SELECT tiket.*, user.name as userName FROM tiket, user WHERE tiket.state = 'open' AND tiket.userID = user.ID;");
	if ($data) {
		$objTheme -> define(Array("MAIN_CONTENT" => "table.tpl", "TH_CONTENT" => "thTiketList.tpl"));
		$listA = "";
		foreach ($data as $key => $val) {
			$listA .= $objTheme -> addDynamic("trTiketList.tpl", $val);
		}
		$objTheme -> assign(Array("TABLE_TITLE" => "{LANG_TIKET_LIST_TITLE}", "TBODY_CONTENT" => $listA));
	} else {
		$objTheme -> warning("{LANG_HAVE_NO_ELEMENT}");
	}
}

require_once "end.php";
?>
