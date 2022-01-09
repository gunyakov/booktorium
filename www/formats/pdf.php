<?php
//-------------------------------------------------------------------------------------------------------------------------
// Модуль: конвертация страниц pdf книги в изображения и распознавание страниц
//-------------------------------------------------------------------------------------------------------------------------
// Version 		    : 2.0 b
// Released		    : 28-feb-2013
// Last Modified  : 09-jun-2014
// Author		      : O.G <http://o-g.promodj.ru>
//-------------------------------------------------------------------------------------------------------------------------
// Лицензия GPL v2
//-------------------------------------------------------------------------------------------------------------------------
// Пример работы скрипта http://demo.dub-project.ru
//-------------------------------------------------------------------------------------------------------------------------
// Для любых пожеланий или баг отчетах пишите мне : og@dub-project.ru
//-------------------------------------------------------------------------------------------------------------------------

//------------------------------------------------------------------------------------------------------------------------
//Получаем общее количество страниц книги
//------------------------------------------------------------------------------------------------------------------------
$totalPages = $currentFile['pages'];
//-------------------------------------------------------------------------------------------
//Если папки пользователя в папке USER_IMAGE_STORAGE не обнаружено
//-------------------------------------------------------------------------------------------
//Формируем путь изображения, для манипуляции в файловой системе
$userPath = $objSession->getUserPath();
$imagePath = USER_IMAGE_STORAGE . $userPath . "/";
//Получаем пользовательский формат изображения
$imgFormat = $objSession->getUserImageFormat();
if (!is_dir($imagePath)) {
    //Создаем папку пользователя
    mkdir($imagePath, MKDIR_MODE);
}
//-------------------------------------------------------------------------------------------
//Манипуляция с изображениями
//-------------------------------------------------------------------------------------------
//Формируем имя изображения
$imageName = $currentFile['fileName'] . "_page" . $currentPage;
//Проверка изображения на сервере
//if ($mode == 'image' && is_file(FILES_COLD_LINK . $userPath . "/" . $imageName . $imgFormat)) {
if ($mode == 'image' && url_exists(FILES_COLD_LINK . $userPath . "/" . $imageName . $imgFormat)) {
    //Выводим изображение в браузер
    $readContent = "<img src='" . FILES_COLD_LINK . $userPath . "/" . $imageName . $imgFormat . "'>";
} else {
//-------------------------------------------------------------------------------------------
//Манипуляция с TIFF изображением
//-------------------------------------------------------------------------------------------
    //Проверяем наличие TIFF файла в БД
    $tiffData = $objDB->select("SELECT * FROM tiffImageList WHERE bookID = " . $bookID . " AND page = " . $currentPage . " AND userID = " . $objSession->getUserID() . " AND fileID = " . $currentFile['ID'] . ";");
    //Если запись об TIFF изображении для данной страницы найдена
    if ($tiffData) {
        //Получаем массив, с данными об изображении
        $tiffData = $tiffData[0];
        //Формируем путь к изображению TIFF
        $tiffImageName = $imagePath . $tiffData['imageName'] . ".tiff";

    } //Если запись об TIFF изображнии для данной страницы не найденна
    else {
        //Формируем случайное имя TIFF изображения
        $tiffImageName = $imageName;
        //Если пользователь авторизирован
        if ($objSession->getUserID() > 0) {
            //Вставляем имя TIFF в БД
            $objDB->insert("tiffImageList", Array("userID" => $objSession->getUserID(), "bookID" => $bookID, "page" => $currentPage, "fileID" => $currentFile["ID"], "imageName" => $tiffImageName));
        }
        //Формируем полный путь к TIFF
        $tiffImageName = $imagePath . $tiffImageName . ".tiff";
    }
    //Если локальный TIFF файл не обнаружен
    if (!is_file($tiffImageName)) {
        //Извлечение страницы в TIFF из DJVU документа
        exec(gs . " -dSAFER -sDEVICE=tiffscaled4 -q -dBATCH -dNOPAUSE -dFirstPage=" . $currentPage . " -dLastPage=" . $currentPage . " -sOutputFile=" . $tiffImageName . " " . FILES_STORAGE . $currentFile['storage'] . "/" . $currentFile['fileName']);
    }
    //Сбрасываем значение, выводимое в READ_CONTENT переменную
    $readContent = "";
    //Если TIFF файл был создан
    if (is_file($tiffImageName)) {
        //-------------------------------------------------------------------------------------------
        //Переключаемся между режимами чтения файла
        //-------------------------------------------------------------------------------------------
        switch (readValue("mode")) {
            case "text" :
                $mode = "text";
                //Если не существует txt  данной страницы
                if (!is_file($imagePath . $imageName . ".txt")) {
                    //Если у пользователя нет ограничения по чтению изображений
                    if (!Limits("ReadText")) {
                        //Распознаем текст
                        //exec(tesseract . " " .$tiffImageName. " " . $imagePath . $imageName . " -l rus+eng");
                        //Если удалось получить распознаный текст
                        if (is_file($imagePath . $imageName . ".txt")) {
                          //Выполняем процедуру пользовательского счета.
                          Amount("ReadText");
                          //Увеличиваем счетчик прочтений книги на 1
                          $objDB->select("UPDATE booksList SET readTextCount = readTextCount + 1 WHERE ID = '" . $bookID . "';");
                          //Читаем результирующий файл
                          $fileContent = file($imagePath . $imageName . ".txt");
                          //Формируем вывод файла
                          if (is_array($fileContent)) {
                              foreach ($fileContent as $key => $val) {
                                  $readContent .= $objTheme->addDynamic("readItemText.tpl", Array("READ_ITEM_CONTENT" => $val));
                              }
                          } else {
                              //Выводим сообщение об этом
                              $readContent = $objTheme->addDynamic("messages/error.tpl", Array("ERROR_CONTENT" => "{LANG_ERROR_READ_CONTENT}"));
                          }
                        }
                        else {
                            //Выводим сообщение об этом
                            $readContent = $objTheme->addDynamic("messages/error.tpl", Array("ERROR_CONTENT" => "{LANG_ERROR_READ_CONTENT}"));
                        }
                    } //Если у пользователя есть ограничения по чтению изображений
                    else {
                        //Выводим сообщение об этом
                        $readContent = $objTheme->addDynamic("messages/error.tpl", Array("ERROR_CONTENT" => "{LANG_LIMIT_REACHED}"));
                    }
                } //Если существует txt данной страницы
                else {
                    //Читаем результирующий файл
                    $fileContent = file($imagePath . $imageName . ".txt");
                    //Формируем вывод файла
                    if (is_array($fileContent)) {
                        foreach ($fileContent as $key => $val) {
                            $readContent .= $objTheme->addDynamic("readItemText.tpl", Array("READ_ITEM_CONTENT" => $val));
                        }
                    } else {
                        //Выводим сообщение об этом
                        $readContent = $objTheme->addDynamic("messages/error.tpl", Array("ERROR_CONTENT" => "{LANG_ERROR_READ_CONTENT}"));
                    }
                }
                break;
            default :
                $mode = "image";
                //Если не существует png изображение данной страницы
                if (!is_file($imagePath . $imageName . $imgFormat)) {
                    //Если у пользователя нет ограничения по чтению изображений
                    if (!Limits("ReadImage")) {
                        //Формируем png
                        exec($objSession->getUserImageRenderString() . $tiffImageName . " " . $imagePath . $imageName . $imgFormat);
                        //Выполняем процедуру пользовательского счета.
                        Amount("ReadImage");
                        //Увеличиваем счетчик прочтений книги на 1
                        $objDB->select("UPDATE booksList SET readCount = readCount + 1 WHERE ID = '" . $bookID . "';");
                        //Выводим изображение в браузер
                        $readContent = "<img src='" . USER_IMAGE_DOWNLOAD_LINK . $userPath . "/" . $imageName . $imgFormat . "'>";
                    } //Если у пользователя есть ограничения по чтению изображений
                    else {
                        //Выводим сообщение об этом
                        $readContent = $objTheme->addDynamic("messages/error.tpl", Array("ERROR_CONTENT" => "{LANG_LIMIT_REACHED}"));
                    }
                } //Если существует png изображение данной страницы
                else {
                    //Выводим изображение в браузер
                    $readContent = "<img src='" . USER_IMAGE_DOWNLOAD_LINK . $userPath . "/" . $imageName . $imgFormat . "'>";
                }
                break;
        }
    } else {
        $readContent = $objTheme->addDynamic("messages/error.tpl", Array("ERROR_CONTENT" => "{LANG_ERROR_FORMAT_IMAGE}"));
    }
}
?>
