<div class="container_12">
    <div class="grid_12">
        <div class="block-border" id="tab-panel-2">
            <div class="block-header">
                <h1>Настройки по умолчанию</h1>
                <ul class="tabs">
                    <li>
                        <a href="#tab-lorem">Не авторизированые пользователи</a>
                    </li>
                    <li>
                        <a href="#tab-dolor">Авторизированые пользователи</a>
                    </li>
                    <li>
                        <a href="#tab-livebookmanager">Live Book Manager</a>
                    </li>
                    <li>
                        <a href="#tab-consectetur">Лимиты</a>
                    </li>
                    <li>
                        <a href="#tab-additional">Дополнительно</a>
                    </li>
                </ul>
            </div>
            <div class="block-content tab-container">
                <div id="tab-lorem" class="tab-content">
                    <form class="block-content form" action="options.php" method="post">
                        <input type="hidden" value="updateOptions" name="action">
                        <fieldset>
                            <legend>
                                Коментарии
                            </legend>
                            <div class=_25>
                                <p>
                                    <span class="label">Просмотр</span>
                                    <label>
                                        <input type="radio" name="nonAuthUserCommentsShow" value="no" {checkednonAuthUserCommentsShowno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="nonAuthUserCommentsShow" value="yes" {checkednonAuthUserCommentsShowyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Отправка</span>
                                    <label>
                                        <input type="radio" name="nonAuthUserCommentsPost" value="no" {checkednonAuthUserCommentsPostno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="nonAuthUserCommentsPost" value="yes" {checkednonAuthUserCommentsPostyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Отправка без АнтиБот</span>
                                    <label>
                                        <input type="radio" name="nonAuthUserCommentsPostAntiBot" value="no" {checkednonAuthUserCommentsPostAntiBotno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="nonAuthUserCommentsPostAntiBot" value="yes" {checkednonAuthUserCommentsPostAntiBotyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                        </fieldset>
                        <div class="clear"></div>
                        <fieldset>
                            <legend>
                                Книги
                            </legend>
                            <div class=_25>
                                <p>
                                    <span class="label">Просмотр</span>
                                    <label>
                                        <input type="radio" name="nonAuthUserBookShow" value="no" {checkednonAuthUserBookShowno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="nonAuthUserBookShow" value="yes" {checkednonAuthUserBookShowyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Чтение</span>
                                    <label>
                                        <input type="radio" name="nonAuthUserBookRead" value="no" {checkednonAuthUserBookReadno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="nonAuthUserBookRead" value="yes" {checkednonAuthUserBookReadyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Загрузка прикрепленых файлов</span>
                                    <label>
                                        <input type="radio" name="nonAuthUserGetFiles" value="no" {checkednonAuthUserGetFilesno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="nonAuthUserGetFiles" value="yes" {checkednonAuthUserGetFilesyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Загрузка без АнтиБот</span>
                                    <label>
                                        <input type="radio" name="nonAuthUserGetFilesAntiBot" value="no" {checkednonAuthUserGetFilesAntiBotno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="nonAuthUserGetFilesAntiBot" value="yes" {checkednonAuthUserGetFilesAntiBotyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                        </fieldset>
                        <div class="clear"></div>
                        <fieldset>
                            <legend>
                                Дополнительно
                            </legend>
                            <div class=_25>
                                <p>
                                    <span class="label">Поиск</span>
                                    <label>
                                        <input type="radio" name="nonAuthUserSearch" value="no" {checkednonAuthUserSearchno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="nonAuthUserSearch" value="yes" {checkednonAuthUserSearchyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Распознавание текста</span>
                                    <label>
                                        <input type="radio" name="nonAuthUserReadText" value="no" {checkednonAuthUserReadTextno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="nonAuthUserReadText" value="yes" {checkednonAuthUserReadTextyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Загрузка полноразмерных TIFF</span>
                                    <label>
                                        <input type="radio" name="nonAuthUserGetFullTIFF" value="no" {checkednonAuthUserGetFullTIFFno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="nonAuthUserGetFullTIFF" value="yes" {checkednonAuthUserGetFullTIFFyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                        </fieldset>
                        <div class="clear"></div>
                        <div class=block-actions>
                            <ul class=actions-left>
                                <li>
                                    <a class="button red reset-validate-form" href="javascript:void(0);">Сброс</a>
                                </li>
                            </ul>
                            <ul class=actions-right>
                                <li>
                                    <input type="submit" class="button" value="Отправить на сервер">
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
                <div id="tab-dolor" class="tab-content">
                    <form class="block-content form" action="options.php" method="post">
                        <input type="hidden" value="updateOptions" name="action">
                        <fieldset>
                            <legend>
                                Коментарии
                            </legend>
                            <div class=_25>
                                <p>
                                    <span class="label">Просмотр</span>
                                    <label>
                                        <input type="radio" name="authUserCommentsShow" value="no" {checkedauthUserCommentsShowno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="authUserCommentsShow" value="yes" {checkedauthUserCommentsShowyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Отправка</span>
                                    <label>
                                        <input type="radio" name="authUserCommentsPost" value="no" {checkedauthUserCommentsPostno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="authUserCommentsPost" value="yes" {checkedauthUserCommentsPostyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Отправка без АнтиБот</span>
                                    <label>
                                        <input type="radio" name="authUserCommentsPostAntiBot" value="no" {checkedauthUserCommentsPostAntiBotno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="authUserCommentsPostAntiBot" value="yes" {checkedauthUserCommentsPostAntiBotyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                        </fieldset>
                        <div class="clear"></div>
                        <fieldset>
                            <legend>
                                Книги
                            </legend>
                            <div class=_25>
                                <p>
                                    <span class="label">Просмотр</span>
                                    <label>
                                        <input type="radio" name="authUserBookShow" value="no" {checkedauthUserBookShowno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="authUserBookShow" value="yes" {checkedauthUserBookShowyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Чтение</span>
                                    <label>
                                        <input type="radio" name="authUserBookRead" value="no" {checkedauthUserBookReadno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="authUserBookRead" value="yes" {checkedauthUserBookReadyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Загрузка прикрепленых файлов</span>
                                    <label>
                                        <input type="radio" name="authUserGetFiles" value="no" {checkedauthUserGetFilesno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="authUserGetFiles" value="yes" {checkedauthUserGetFilesyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Загрузка без АнтиБот</span>
                                    <label>
                                        <input type="radio" name="authUserGetFilesAntiBot" value="no" {checkedauthUserGetFilesAntiBotno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="authUserGetFilesAntiBot" value="yes" {checkedauthUserGetFilesAntiBotyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                        </fieldset>
                        <div class="clear"></div>
                        <fieldset>
                            <legend>
                                Дополнительно
                            </legend>
                            <div class=_25>
                                <p>
                                    <span class="label">Поиск</span>
                                    <label>
                                        <input type="radio" name="authUserSearch" value="no" {checkedauthUserSearchno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="authUserSearch" value="yes" {checkedauthUserSearchyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Распознавание текста</span>
                                    <label>
                                        <input type="radio" name="authUserReadText" value="no" {checkedauthUserReadTextno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="authUserReadText" value="yes" {checkedauthUserReadTextyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Загрузка полноразмерных TIFF</span>
                                    <label>
                                        <input type="radio" name="authUserGetFullTIFF" value="no" {checkedauthUserGetFullTIFFno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="authUserGetFullTIFF" value="yes" {checkedauthUserGetFullTIFFyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                        </fieldset>
                        <div class="clear"></div>
                        <div class="block-actions">
                            <ul class="actions-left">
                                <li>
                                    <a class="button red" href="javascript:void(0);">Сброс</a>
                                </li>
                            </ul>
                            <ul class="actions-right">
                                <li>
                                    <input type="submit" class="button" value="Отправить на сервер">
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
                <div id="tab-livebookmanager" class="tab-content">
                    <form class="block-content form" action="options.php" method="post">
                        <input type="hidden" value="updateOptions" name="action">
                        <fieldset>
                            <legend>
                                Книги
                            </legend>
                            <div class=_25>
                                <p>
                                    <span class="label">Добавление</span>
                                    <label>
                                        <input type="radio" name="authUserBookAdd" value="no" {checkedauthUserBookAddno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="authUserBookAdd" value="yes" {checkedauthUserBookAddyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Редактирование</span>
                                    <label>
                                        <input type="radio" name="authUserBookEdit" value="no" {checkedauthUserBookEditno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="authUserBookEdit" value="yes" {checkedauthUserBookEdityes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Редактирование всех книг</span>
                                    <label>
                                        <input type="radio" name="authUserBookEditAll" value="no" {checkedauthUserBookEditAllno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="authUserBookEditAll" value="yes" {checkedauthUserBookEditAllyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                        </fieldset>
                        <div class="clear"></div>
                        <fieldset>
                            <legend>
                                Автора
                            </legend>
                            <div class=_25>
                                <p>
                                    <span class="label">Добавление</span>
                                    <label>
                                        <input type="radio" name="authUserAuthorAdd" value="no" {checkedauthUserAuthorAddno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="authUserAuthorAdd" value="yes" {checkedauthUserAuthorAddyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Редактирование</span>
                                    <label>
                                        <input type="radio" name="authUserAuthorEdit" value="no" {checkedauthUserAuthorEditno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="authUserAuthorEdit" value="yes" {checkedauthUserAuthorEdityes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Редактирование всех авторов</span>
                                    <label>
                                        <input type="radio" name="authUserAuthorEditAll" value="no" {checkedauthUserAuthorEditAllno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="authUserAuthorEditAll" value="yes" {checkedauthUserAuthorEditAllyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                        </fieldset>
                        <div class="clear"></div>
                        <fieldset>
                            <legend>
                                Издательства
                            </legend>
                            <div class=_25>
                                <p>
                                    <span class="label">Добавление</span>
                                    <label>
                                        <input type="radio" name="authUserPrintAdd" value="no" {checkedauthUserPrintAddno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="authUserPrintAdd" value="yes" {checkedauthUserPrintAddyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Редактирование</span>
                                    <label>
                                        <input type="radio" name="authUserPrintEdit" value="no" {checkedauthUserPrintEditno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="authUserPrintEdit" value="yes" {checkedauthUserPrintEdityes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Редактирование всех издательств</span>
                                    <label>
                                        <input type="radio" name="authUserPrintEditAll" value="no" {checkedauthUserPrintEditAllno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="authUserPrintEditAll" value="yes" {checkedauthUserPrintEditAllyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                        </fieldset>
                        <div class="clear"></div>
                        <div class="block-actions">
                            <ul class="actions-left">
                                <li>
                                    <a class="button red" href="javascript:void(0);">Сброс</a>
                                </li>
                            </ul>
                            <ul class="actions-right">
                                <li>
                                    <input type="submit" class="button" value="Отправить на сервер">
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
                <div id="tab-consectetur" class="tab-content">
                    <form class="block-content form" action="options.php" method="post">
                        <input type="hidden" value="updateOptions" name="action">
                        <fieldset>
                            <legend>
                                Коментарии
                            </legend>
                            <div class=_25>
                                <p>
                                    <label>Ограничение</label>
                                    <input name="nonAuthUserLimitCommentsPost" type="text" value="{nonAuthUserLimitCommentsPost}"/>
                                </p>
                            </div>
                            <br class='clear'>
                            <div class=_25>
                                <p>
                                    <label>Стоимость</label>
                                    <input name="nonAuthUserAmountCommentsPost" type="text" value="{nonAuthUserAmountCommentsPost}"/>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <label>Ограничение начисления</label>
                                    <input type="text" name="nonAuthUserCountCommentsPost" value="{nonAuthUserCountCommentsPost}"/>
                                </p>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>
                                Просмотр книг в виде изображений
                            </legend>
                            <div class=_25>
                                <p>
                                    <label>Ограничение</label>
                                    <input name="nonAuthUserLimitReadImage" type="text" value="{nonAuthUserLimitReadImage}"/>
                                </p>
                            </div>
                            <br class='clear'>
                            <div class=_25>
                                <p>
                                    <label>Стоимость</label>
                                    <input name="nonAuthUserAmountReadImage" type="text" value="{nonAuthUserAmountReadImage}"/>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <label>Ограничение начисления</label>
                                    <input type="text" name="nonAuthUserCountReadImage" value="{nonAuthUserCountReadImage}"/>
                                </p>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>
                                Распозвавание страниц
                            </legend>
                            <div class=_25>
                                <p>
                                    <label>Ограничение</label>
                                    <input name="nonAuthUserLimitReadText" type="text" value="{nonAuthUserLimitReadText}"/>
                                </p>
                            </div>
                            <br class='clear'>
                            <div class=_25>
                                <p>
                                    <label>Стоимость</label>
                                    <input name="nonAuthUserAmountReadText" type="text" value="{nonAuthUserAmountReadText}"/>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <label>Ограничение начисления</label>
                                    <input type="text" name="nonAuthUserCountReadText" value="{nonAuthUserCountReadText}"/>
                                </p>
                            </div>

                        </fieldset>
                        <fieldset>
                            <legend>
                                Загрузка файлов
                            </legend>
                            <div class=_25>
                                <p>
                                    <label>Ограничение</label>
                                    <input name="nonAuthUserLimitGetFiles" type="text" value="{nonAuthUserLimitGetFiles}"/>
                                </p>
                            </div>
                            <br class='clear'>
                            <div class=_25>
                                <p>
                                    <label>Стоимость</label>
                                    <input name="nonAuthUserAmountGetFiles" type="text" value="{nonAuthUserAmountGetFiles}"/>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <label>Ограничение начисления</label>
                                    <input type="text" name="nonAuthUserCountGetFiles" value="{nonAuthUserCountGetFiles}"/>
                                </p>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>
                                Авторизация
                            </legend>
                            <div class=_25>
                                <p>
                                    <label>Ограничение</label>
                                    <input name="nonAuthUserLimitLogin" type="text" value="{nonAuthUserLimitLogin}"/>
                                </p>
                            </div>
                            <br class='clear'>
                            <div class=_25>
                                <p>
                                    <label>Стоимость</label>
                                    <input name="nonAuthUserAmountLogin" type="text" value="{nonAuthUserAmountLogin}"/>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <label>Ограничение начисления</label>
                                    <input type="text" name="nonAuthUserCountLogin" value="{nonAuthUserCountLogin}"/>
                                </p>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>
                                Загрузка полноразмерных TIFF
                            </legend>
                            <div class=_25>
                                <p>
                                    <label>Ограничение</label>
                                    <input name="nonAuthUserLimitGetFullTIFF" type="text" value="{nonAuthUserLimitGetFullTIFF}"/>
                                </p>
                            </div>
                            <br class='clear'>
                            <div class=_25>
                                <p>
                                    <label>Стоимость</label>
                                    <input name="nonAuthUserAmountGetFullTIFF" type="text" value="{nonAuthUserAmountGetFullTIFF}"/>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <label>Ограничение начисления</label>
                                    <input type="text" name="nonAuthUserCountGetFullTIFF" value="{nonAuthUserCountGetFullTIFF}"/>
                                </p>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>
                                Поиск информации
                            </legend>
                            <div class=_25>
                                <p>
                                    <label>Ограничение</label>
                                    <input name="nonAuthUserLimitSearch" type="text" value="{nonAuthUserLimitSearch}"/>
                                </p>
                            </div>
                            <br class='clear'>
                            <div class=_25>
                                <p>
                                    <label>Стоимость</label>
                                    <input name="nonAuthUserAmountSearch" type="text" value="{nonAuthUserAmountSearch}"/>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <label>Ограничение начисления</label>
                                    <input type="text" name="nonAuthUserCountSearch" value="{nonAuthUserCountSearch}"/>
                                </p>
                            </div>
                        </fieldset>
                        <div class=block-actions>
                            <ul class=actions-left>
                                <li>
                                    <input type="reset" class="button" value="Сброс">
                                </li>
                            </ul>
                            <ul class=actions-right>
                                <li>
                                    <input type="submit" class="button" value="Отправить на сервер">
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
                <div id="tab-additional" class="tab-content">
                    <form class="block-content form" action="options.php" method="post">
                        <input type="hidden" name="action" value="fullReset">
                        <div class="clear height-fix"></div>
                        <input type="submit" class="button" value="Сбросить настройки всех пользователей к настройкам по умолчанию">
                        <div class="clear height-fix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="clear height-fix"></div>
</div>
