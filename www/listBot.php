<?php
require_once "initd.php";

$data = $objDB -> select("SELECT * FROM booksList WHERE approved = 'list' ORDER BY datePut LIMIT 1;");
if ($data) {
	if($objDB -> update("booksList", array("approved" => "yes", "datePut" => "NOW()"), array("ID" => $data[0]['ID']))) {
		echo("yes");
	}
	else {
		echo("no");
	}
}
$objDB = 0;
?>
