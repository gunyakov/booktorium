<?php
/***************************************************************************************************
 * Функция: Чтение данных из $_POST или $_GET переменных
 ***************************************************************************************************
 * Version 		  : 1.2 stable
 * Released		  : 24-feb-2013
 * Last Modified  : 27-feb-2013
 * Author		  : O.G <oleg_gunyakov@mail.ru>
 ***************************************************************************************************
 * Лицензия GPL v2
 ***************************************************************************************************
 * Пример работы скрипта http://t-library.org.ua
 ***************************************************************************************************
 * Для любых пожеланий или баг отчетах пишите мне : oleg_goodzon@mail.ru
 ***************************************************************************************************/
//---------------------------------------------------------------------------------------------------------------
//Базовая функция
//---------------------------------------------------------------------------------------------------------------
function readValue($key) {
	//Получаем данные из $_GET массива
	$value = @$_GET[$key];
	//Если данных нет
	if(empty($value)) {
		//Получаем данные из $_POST массива
		$value = @$_POST[$key];
	}
	//Если данные существуют
	if(!empty($value)) {
		//Предотвращаем добавление скриптов и html в БД
		$value = htmlspecialchars(stripslashes($value));
		//Возвращаем данные
		return $value;
	}
	//Если данных не существует
	else {
		//Возвращаем ошибку
		return false;
	}
}
//---------------------------------------------------------------------------------------------------------------
//Вспомогательная функция чтения цифровых данных
//---------------------------------------------------------------------------------------------------------------
function readValueNum($key) {
	//Читаем данные с помощью базовой функции
	$value = readValue($key);
	//Если данные имеют цифровой формат
	if(is_numeric($value)) {
		//Возвращаем данные
		return $value;
	}
	//Если данные имеют не цифровой формат
	else {
		//Возвращаем ошибку
		return false;
	}
}

function url_exists($url){
	 $ch = curl_init($url);
	 curl_setopt($ch, CURLOPT_NOBODY, true);
	 curl_exec($ch);
	 $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	 if ($code == 200) {
			 $status = true;
	 } else {
			 $status = false;
	 }
	 curl_close($ch);
	 return $status;
}
?>
