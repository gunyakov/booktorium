<?php
/***************************************************************************************************
 * Модуль: Пользовательский счет
 ***************************************************************************************************
 * Version 		  : 1.0 beta
 * Released		  : 7-mar-2013
 * Last Modified  : 7-mar-2013
 * Author		  : O.G <oleg_gunyakov@mail.ru>
 ***************************************************************************************************
 * Лицензия GPL v2
 ***************************************************************************************************
 * Пример работы скрипта http://t-library.org.ua
 ***************************************************************************************************
 * Для любых пожеланий или баг отчетах пишите мне : oleg_goodzon@mail.ru
 ***************************************************************************************************/
function Amount($optionName) {
	$objSession = $GLOBALS['objSession'];
	$objOptions = $GLOBALS['objOptions'];
	$objDB = $GLOBALS['objDB'];

	//Устанавливаем значение стоимости события по умолчанию
	$amount = 0;
	//Если Amount разрешен
	if (AMOUNT_MODULE) {
		$data = false;
		//Проверяем авторизированный ли пользователь
		if ($objSession -> getUserID() != 0) {
			//Если пользователь авторизирован, пробуем определить стоимость события для конкретного пользователя
			$data = $objDB -> select("SELECT value FROM userOptions WHERE userID=" . $objSession -> getUserID() . " AND name ='Amount" . $optionName . "';");
			//Если стоимость события не найдена
			if (!$data) {
				//Пробуем определить стоимость события для авторизированного пользователя
				$data = $objDB -> select("SELECT value FROM userOptions WHERE userID=0 AND name ='authUserAmount" . $optionName . "';");
			}
		}
		//Если пользователь не авторизирован
		if (!$data) {
			//Определяем стоимость события для неавторизированного пользователя
			$data = $objDB -> select("SELECT value FROM userOptions WHERE userID=0 AND name ='nonAuthUserAmount" . $optionName . "';");
		}
		//Если удалось получить стоимость события
		if (is_numeric(@$data[0]['value'])) {
			//Извлекаем стоимость события
			$amount = $data[0]['value'];
		}
		//Если пользователь авторизирован и стоимость события отличается от 0
		if ($objSession -> getUserID() && $amount != 0) {
			//Получаем текущий счетчик события
			$currentCount = $objOptions -> getOption("CurrentCount" . $optionName);
			//Получаем кол-во событий, за которые начисляется Amount
			$maxCount = $objOptions -> getOption("Count" . $optionName);
			//Устанавливаем, что обновлять Amount пользователя не нужно
			$changeAmount = false;
			//Если максимальный счетчик равен 0
			if ($maxCount == 0) {
				//То обновляем Amount всегда
				$changeAmount = true;
			}
			//Если максимальный счетчик не равен 0
			else {
				//Проверяем что текущий счетчик меньше кол-ва событий, за которые начислыется Amount
				if ($currentCount < $maxCount) {
					//Если да, то обновляем Amount
					$changeAmount = true;
				}
			}
			//Обновляем Amount, если разрешено
			if ($changeAmount) {
				//Обновляем пользовательский счет
				$objDB -> select("UPDATE user SET amount = amount + " . $amount . " WHERE ID=" . $objSession -> getUserID() . ";");
			}
		}
	}
	//Обновляем текущий счетчик события
	$objOptions -> updateOption("CurrentCount" . $optionName);
	//Возвращаем стоимость события
	return $amount;
}
?>