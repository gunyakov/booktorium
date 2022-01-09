<?php
require_once "getString.php";
require_once "rating.php";
//Выполняем код только если разрешен модуль Промо
if (PROMO_VIEW) {
	//Если нужно перехватывать создание сервисных сообщений и сервисное сообщение было создано
	if (CHECK_SERVICE_MESSAGE_CREATION && $serviceMessage) {
		//Не выводим промо контент
		$objTheme -> assign(Array("PROMO_VIEW" => ""));	
	} 
	//В других случаях, формируем и выводим промо контент
	else {
		$objTheme -> define(Array("PROMO_VIEW" => "promoView.tpl"));
		$promoList = "";
		$data = $objDB -> select("SELECT *, DATE_FORMAT(datePut, '%d %b %Y') as datePut FROM booksList ORDER BY RAND() LIMIT 4;");
		if ($data) {
			$i = 0;
			foreach ($data as $key => $val) {
				$objBook = new Book($val['ID']);
				$imageName = $objBook -> getInfo();
				$val['imageName'] = $imageName['imageName'];
				$val['name'] = getString($val['name']);
				$val['rating'] = getRating($val['rating']);
				//Установка данных шаблона, для правильного его отображения
				if($i == 0) {
					$val['active'] = "active";
				}
				else {
					$val['active'] = "";
				}
				$i++;
				$promoList .= $objTheme -> addDynamic("promoViewItem.tpl", $val);
			}
		}
		$objTheme -> assign(Array("PROMO_CONTENT" => $promoList));
	}
} 
//Если модуль промо запрещен
else {
	//Не выводим промо контент
	$objTheme -> assign(Array("PROMO_VIEW" => ""));
}
?>
