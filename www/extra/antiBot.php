<?php
require_once "../config.php";
require_once "../class/class.DB.php";
global $objDB;
$objDB = new DB();

require_once "../class/class.AntiBot.php";

$objAntiBot = new AntiBot();

$objAntiBot->getImage();
?>
