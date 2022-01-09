<?php

require_once "initd.php";

require_once "extra/readValue.php";

if (readValueNum("id")) {
	$data = $objDB -> select("SELECT * FROM booksMessages WHERE ID = " . readValue("id") . ";");
	if ($data) {
		switch(readValue("action")) {
			case "approve" :
				if ($objDB -> update("booksMessages", Array("approved" => "yes"), Array("ID" => readValue("id")))) {
					$objTheme -> success("{LANG_UPDATE_TRUE}");
				} else {
					$objTheme -> error("{LANG_UPDATE_FALSE}");
				}
				break;
			case "delComment" :
				if ($objDB -> delete("booksMessages", Array("ID" => readValue("id")))) {
					$objTheme -> success("{LANG_DEL_TRUE}");
				} else {
					$objTheme -> error("{LANG_DEL_FALSE}");
				}
				break;
			case "delAndBan" :
				if ($objDB -> delete("booksMessages", Array("ID" => readValue("id")))) {
					if($objDB -> update("user", Array("ban" => "yes"), Array("ID" => $data[0]['userID']))) {
						$objTheme -> success("{LANG_DEL_TRUE}, {LANG_BAN_TRUE}");	
					}
					else {
						$objTheme -> warning("{LANG_DEL_TRUE}, {LANG_BAN_FALSE}");		
					}
				} else {
					$objTheme -> error("{LANG_DEL_FALSE}");
				}
				break;
			default :
				$objTheme -> define(Array("MAIN_CONTENT" => "commentForm.tpl"));
				$objTheme -> assign($data[0]);
		}
	} else {
		$objTheme -> warning("{LANG_HAVE_NO_ELEMENT}");
	}
} else {
	$data = $objDB -> select("SELECT booksMessages.*, booksList.name as bookName FROM booksMessages, booksList WHERE booksMessages.approved = 'no' AND booksMessages.bookID = booksList.ID;");
	if ($data) {
		$objTheme -> define(Array("MAIN_CONTENT" => "table.tpl", "TH_CONTENT" => "thCommentList.tpl"));
		$listA = "";
		foreach ($data as $key => $val) {
			if (strlen($val['message']) > 100) {
				$val['message'] = substr($val['message'], 0, 99) . "...";
			}
			$listA .= $objTheme -> addDynamic("trCommentList.tpl", $val);
		}
		$objTheme -> assign(Array("TABLE_TITLE" => "{LANG_COMMENT_LIST_TITLE}", "TBODY_CONTENT" => $listA));
	} else {
		$objTheme -> warning("{LANG_HAVE_NO_ELEMENT}");
	}
}

require_once "end.php";
?>
