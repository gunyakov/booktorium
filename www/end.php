<?php
//Выполняем код промо контента
require_once "extra/promoView.php";

$objDB = 0;
$objOptions = 0;
$objSession = 0;

$time_end = getmicrotime();
$time = $time_end - $time_start;
$objTheme -> assign(Array("EXECUTE_TIME" => round($time, 4)));
$objTheme -> templatePrint();
$objTheme = 0;
?>
