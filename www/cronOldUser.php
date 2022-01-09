<?php
error_reporting(E_ALL); // Вывод ошибок.
require_once "config.php";
//Инициализация сласса базы данных.
require_once "class/class.DB.php";
$objDB = new DB();
//Инициализация класса отправки писем.
require_once "class/class.EMail.php";
$objEmail = new EMail($objDB);

//--------------------------------------------------------------------------------------------------
//Выбираем пользователей, у которых нет подтвержедния почты и которые еще не удалены
$data = $objDB -> select("SELECT email, ID, name FROM user WHERE emailConfirm = 'no';");
//Если пользователи есть
if ($data) {
	//Проходим по списку пользователей.
	foreach ($data as $key => $val) {
		//Получаем хеш строку подтверждения
		$hash = $objDB -> select("SELECT * FROM confirmEmail WHERE userID=" . $val['ID']);
		//Если строки нет
		if (!$hash) {
			//Создаем ее
			$hash = md5(time().$val['name']);
			//Сохраняем в базе
			$objDB -> insert("confirmEmail", Array("userID" => $val['ID'], "hash" => $hash, "datePut" => "NOW()"));
		}
		//Если строока существует
		else {
			//Извлекаем строку
			$hash = $hash[0]['hash'];
		}
		//Формируем тело письма
		$objEmail -> add_html(Array("EMAIL_TITLE" => "Уведомление об неподтвержденном email.", "EMAIL_CONTENT" => "Вы не подтвердили свой email. Подтвердите его перейдя по <a href='https://t-library.net/confirm.php?hash_str=" . $hash . "'>ссылке</a> или ваш аккаунт будет удален.<br> С уважением, Команда t-library.net"));
		//Отправляем письмо
		$objEmail -> send(0, $val['email'], "Неподтвержденная почта.");
		
	}
}
?>
