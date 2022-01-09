<?php
//Если разрешено автоматическое создание опций сортировки книг.
if (SORT_OPTIONS) {
	//Выбираем общий счетчик книг категории из БД
	$data = $objDB -> select("SELECT COUNT(booksList.ID) as countID FROM booksList, booksCategoryList WHERE booksCategoryList.categoryID = " . readValue("id") . " AND booksList.ID = booksCategoryList.bookID AND booksList.approved = 'yes';");
	//Если счетчик не получен
	if (!$data) {
		//Обнуляем меню сортировки
		$objTheme -> assign(Array("SORT_OPTIONS" => ""));
	}
	//Если счетчик получен
	else {
		//Если счетчик меньше одной книги
		if ($data[0]['countID'] < 1) {
			//Обнуляем меню сортировки
			$objTheme -> assign(Array("SORT_OPTIONS" => ""));
		}
		//Если счетчик книг больше нуля
		else {
			//Устанавливаем шаблон вывода
			$objTheme -> define(Array("SORT_OPTIONS" => "showCategory.php/sort.tpl"));
			//Если переданны какие нибудь данные
			if (readValue("field")) {
				setcookie(readValue("field"), readValue("value"), 0, "/", "", 0);
			}

			$arrFullOptions = Array();

			$data = $objDB -> select("DESCRIBE booksList;");
			if ($data) {
				foreach ($data as $key => $val) {
					$name = "";
					foreach ($val as $key2 => $val2) {
						if ($key2 == "Field") {
							$name = $val2;
						}
						if ($key2 == "Type" && $name != "free" && $name != "approved") {// && $name != "format") {
							if (substr($val2, 0, 4) == "enum") {
								$val2 = substr($val2, 5, strlen($val2) - 6);
								$val2 = str_replace("'", "", $val2);
								$val2 = explode(",", $val2);
								$arrOptions = Array();
								foreach ($val2 as $key3 => $val3) {
									$arrOptions[$val3] = $val3;
								}
								//echo($val2);
								$arrFullOptions[$name] = $arrOptions;
							}
						}
					}
				}
			}
			//Обнуление строки выводимого контента
			$strContent = '';
			$arrSort = Array();
			foreach ($arrFullOptions as $key => $val) {
				$strItem = '';
				foreach ($val as $key2 => $val2) {
					//--------------------------------------------------------------------------------------------------------------
					//Формируем строку ссылки
					//--------------------------------------------------------------------------------------------------------------
					$link = "showCategory.php?id={CATEGORY_ID}&view={VIEW}&sort={SORT}&field=" . $key;
					$dataCount = $objDB -> select("SELECT COUNT(booksList.ID) as countID FROM booksList, booksCategoryList WHERE booksCategoryList.categoryID = " . readValue("id") . " AND booksList.ID = booksCategoryList.bookID AND booksList.approved = 'yes' AND booksList." . $key . " = '" . $key2 . "';");
					if ($dataCount) {
						$dataCount = $dataCount[0]['countID'];
					} else {
						$dataCount = 0;
					}
					//--------------------------------------------------------------------------------------------------------------
					//Обрабатываем куки
					//--------------------------------------------------------------------------------------------------------------
					$activeItem = false;

					if (readValue("field") == $key) {
						if (readValue("value") == $key2) {
							$arrSort[$key] = readValue("value");
							$activeItem = true;
						}
					} else {
						if (@$_COOKIE[$key] == $key2) {
							$arrSort[$key] = $key2;
							$activeItem = true;
						}
					}
					if ($activeItem) {
						$strItem .= $objTheme -> addDynamic("showCategory.php/sortItemNoLink.tpl", Array("ITEM_NAME" => "{TXT_KEY_" . strtoupper($val2) . "}", "ITEM_LINK" => $link, "ITEM_COUNT" => $dataCount));
					} else {
						$strItem .= $objTheme -> addDynamic("showCategory.php/sortItem.tpl", Array("ITEM_NAME" => "{TXT_KEY_" . strtoupper($val2) . "}", "ITEM_LINK" => $link . "&value=" . $key2, "ITEM_COUNT" => $dataCount));
					}
				}
				$strContent .= $objTheme -> addDynamic("showCategory.php/sortBlock.tpl", Array("BLOCK_NAME" => "{TXT_KEY_" . strtoupper($key) . "}", "BLOCK_CONTENT" => $strItem));
			}
			$objTheme -> assign(Array("SORT_OPTIONS_CONTENT" => $strContent));
		}
	}
} 
//Если запрещено автоматическое создание опций сортировки книг.
else {
	//Обнуляем меню сортировки
	$objTheme -> assign(Array("SORT_OPTIONS" => ""));
}
?>
