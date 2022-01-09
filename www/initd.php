<?php
if($_SERVER['HTTP_USER_AGENT']  == "Mozilla/5.0 (compatible; AhrefsBot/5.0; +http://ahrefs.com/robot/)" || $_SERVER['HTTP_USER_AGENT']  == "Mozilla/5.0 (compatible; MJ12bot/v1.4.4; http://www.majestic12.co.uk/bot.php?+)") {
	echo("Доступ к сайту запрещен, так как мы определили, что вы являетесь роботом AhrefsBot. Если это не так, обратитесь в службу поддержки help@t-library.org.ua.");
	exit(1);
}
function getmicrotime() {
	list($usec, $sec) = explode(" ", microtime());
	return ((float)$usec + (float)$sec);
}

$time_start = getmicrotime();

global $serviceMessage;
$serviceMessage = false;
//--------------------------------------------------------------------------------------------------
//Чтение настроек
//--------------------------------------------------------------------------------------------------
require_once "config.php";

require_once "class/class.Book.php";
//--------------------------------------------------------------------------------------------------
//Инициализация обьекта "База данных"
//--------------------------------------------------------------------------------------------------
require_once "class/class.DB.php";
global $objDB;
$objDB = new DB();

require_once "class/class.UserSession.php";
global $objSession;
$objSession = new UserSession();

require_once "class/class.Options.php";
global $objOptions;
$objOptions = new Options();

require_once "class/class.AntiBot.php";
global $objAntiBot;
$objAntiBot = new AntiBot();

require_once "class/class.Template.php";
global $objTheme;

$objTheme = new Template(THEME_PATH);
require_once THEME_PATH . "/php/include.Options.php";
require_once THEME_PATH . "/php/include.Language.php";

$data = $objDB -> select("SELECT * FROM categoryList WHERE parentID = 0;");
if ($data) {
	$mainMenu = "";
	foreach ($data as $key => $val) {
		$mainMenu .= $objTheme -> addDynamic("menuMain.tpl", $val);
	}
	$objTheme -> assign(Array("MAIN_MENU_CONTENT" => $mainMenu));
}
else {
	echo($objDB -> getError());
}

if ($objSession -> getUserID()) {
	$objTheme -> define(Array("TOP_MENU_CONTENT" => "loginTrue.tpl"));
} else {
	$objTheme -> define(Array("TOP_MENU_CONTENT" => "loginFalse.tpl"));
}

require_once "extra/amount.php";
require_once "extra/limits.php";
require_once "extra/getString.php";
require_once "extra/readValue.php";

require_once "extra/stat.php";
?>
