<div class="container_12">
    <div class="grid_12">
        <div class="block-border" id="tab-panel-2">
            <div class="block-header">
                <h1>Настройки пользователя {name}, Статус: {state}</h1>
                <ul class="tabs">
                    <li>
                        <a href="#tab-lorem">Персональные настройки</a>
                    </li>
                    <li>
                        <a href="#tab-livebookmanager">Live Book Manager</a>
                    </li>
                    <li>
                        <a href="#tab-dolor">Ограничения</a>
                    </li>
                </ul>
            </div>
            <div class="block-content tab-container">
                <div id="tab-lorem" class="tab-content">
                    <form id="validate-form" class="block-content form" action="userOption.php?id={ID}" method="post">
                        <input type="hidden" value="updateLimits" name="action">
                        <fieldset>
                            <legend>
                                Коментарии
                            </legend>
                            <div class=_25>
                                <p>
                                    <label>Ограничение</label>
                                    <input name="LimitCommentsPost" type="text" value="{LimitCommentsPost}"/>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <label>Текущий Счетчик</label>
                                    <input name="CurrentCountCommentsPost" type="text" value="{CurrentCountCommentsPost}"/>
                                </p>
                            </div>

                            <br class='clear'>
                            <div class=_25>
                                <p>
                                    <label>Стоимость</label>
                                    <input name="AmountCommentsPost" type="text" value="{AmountCommentsPost}"/>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <label>Ограничение начисления</label>
                                    <input type="text" name="CountCommentsPost" value="{CountCommentsPost}"/>
                                </p>
                            </div>
                            <br class='clear'>
                            <a class="clase-toolbox button red" href="userOption.php?id={ID}&action=resetCommentsPost">Сбросить</a>
                        </fieldset>
                        <fieldset>
                            <legend>
                                Просмотр книг в виде изображений
                            </legend>
                            <div class=_25>
                                <p>
                                    <label>Ограничение</label>
                                    <input name="LimitReadImage" type="text" value="{LimitReadImage}"/>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <label>Текущий Счетчик</label>
                                    <input name="CurrentCountReadImage" type="text" value="{CurrentCountReadImage}"/>
                                </p>
                            </div>

                            <br class='clear'>
                            <div class=_25>
                                <p>
                                    <label>Стоимость</label>
                                    <input name="AmountReadImage" type="text" value="{AmountReadImage}"/>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <label>Ограничение начисления</label>
                                    <input type="text" name="CountReadImage" value="{CountReadImage}"/>
                                </p>
                            </div>
                            <br class='clear'>
                            <a class="clase-toolbox button red" href="userOption.php?id={ID}&action=resetReadImage">Сбросить</a>

                        </fieldset>
                        <fieldset>
                            <legend>
                                Распозвавание страниц
                            </legend>
                            <div class=_25>
                                <p>
                                    <label>Ограничение</label>
                                    <input name="LimitReadText" type="text" value="{LimitReadText}"/>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <label>Текущий Счетчик</label>
                                    <input name="CurrentCountReadText" type="text" value="{CurrentCountReadText}"/>
                                </p>
                            </div>

                            <br class='clear'>
                            <div class=_25>
                                <p>
                                    <label>Стоимость</label>
                                    <input name="AmountReadText" type="text" value="{AmountReadText}"/>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <label>Ограничение начисления</label>
                                    <input type="text" name="CountReadText" value="{CountReadText}"/>
                                </p>
                            </div>
                            <br class='clear'>
                            <a class="clase-toolbox button red" href="userOption.php?id={ID}&action=resetReadText">Сбросить</a>

                        </fieldset>
                        <fieldset>
                            <legend>
                                Загрузка файлов
                            </legend>
                            <div class=_25>
                                <p>
                                    <label>Ограничение</label>
                                    <input name="LimitGetFiles" type="text" value="{LimitGetFiles}"/>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <label>Текущий Счетчик</label>
                                    <input name="CurrentCountGetFiles" type="text" value="{CurrentCountGetFiles}"/>
                                </p>
                            </div>

                            <br class='clear'>
                            <div class=_25>
                                <p>
                                    <label>Стоимость</label>
                                    <input name="AmountGetFiles" type="text" value="{AmountGetFiles}"/>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <label>Ограничение начисления</label>
                                    <input type="text" name="CountGetFiles" value="{CountGetFiles}"/>
                                </p>
                            </div>
                            <br class='clear'>
                            <a class="clase-toolbox button red" href="userOption.php?id={ID}&action=resetGetFiles">Сбросить</a>
                        </fieldset>
                        <fieldset>
                            <legend>
                                Авторизация
                            </legend>
                            <div class=_25>
                                <p>
                                    <label>Ограничение</label>
                                    <input name="LimitLogin" type="text" value="{LimitLogin}"/>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <label>Текущий Счетчик</label>
                                    <input name="CurrentCountLogin" type="text" value="{CurrentCountLogin}"/>
                                </p>
                            </div>

                            <br class='clear'>
                            <div class=_25>
                                <p>
                                    <label>Стоимость</label>
                                    <input name="AmountLogin" type="text" value="{AmountLogin}"/>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <label>Ограничение начисления</label>
                                    <input type="text" name="CountLogin" value="{CountLogin}"/>
                                </p>
                            </div>
                            <br class='clear'>
                            <a  class="clase-toolbox button red" href="userOption.php?id={ID}&action=resetLogin">Сбросить</a>
                        </fieldset>
                        <fieldset>
                            <legend>
                                Загразка полноразмерных TIFF
                            </legend>
                            <div class=_25>
                                <p>
                                    <label>Ограничение</label>
                                    <input name="LimitGetFullTIFF" type="text" value="{LimitGetFullTIFF}"/>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <label>Текущий Счетчик</label>
                                    <input name="CurrentCountGetFullTIFF" type="text" value="{CurrentCountGetFullTIFF}"/>
                                </p>
                            </div>

                            <br class='clear'>
                            <div class=_25>
                                <p>
                                    <label>Стоимость</label>
                                    <input name="AmountGetFullTIFF" type="text" value="{AmountGetFullTIFF}"/>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <label>Ограничение начисления</label>
                                    <input type="text" name="CountGetFullTIFF" value="{CountGetFullTIFF}"/>
                                </p>
                            </div>
                            <br class='clear'>
                            <a class="clase-toolbox button red" href="userOption.php?id={ID}&action=resetGetFullTIFF">Сбросить</a>
                        </fieldset>
                        <fieldset>
                            <legend>
                                Поиск информации
                            </legend>
                            <div class=_25>
                                <p>
                                    <label>Ограничение</label>
                                    <input name="LimitSearch" type="text" value="{LimitSearch}"/>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <label>Текущий Счетчик</label>
                                    <input name="CurrentCountSearch" type="text" value="{CurrentCountSearch}"/>
                                </p>
                            </div>

                            <br class='clear'>
                            <div class=_25>
                                <p>
                                    <label>Стоимость</label>
                                    <input name="AmountSearch" type="text" value="{AmountSearch}"/>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <label>Ограничение начисления</label>
                                    <input type="text" name="CountSearch" value="{CountSearch}"/>
                                </p>
                            </div>
                            <br class='clear'>
                            <a class="clase-toolbox button red" href="userOption.php?id={ID}&action=resetSearch">Сбросить</a>
                        </fieldset>
                        <div class=block-actions>
                            <ul class=actions-left>
                                <li>
                                    <a class="clase-toolbox button red" href="userOption.php?id={ID}&action=resetFull">Сброс настроек по умолчанию</a>
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
                <div id="tab-livebookmanager" class="tab-content">
                    <form class="block-content form" action="userOption.php?id={ID}" method="post">
                        <input type="hidden" value="updateActions" name="action">
                        <fieldset>
                            <legend>
                                Книги
                            </legend>
                            <div class=_25>
                                <p>
                                    <span class="label">Добавление</span>
                                    <label>
                                        <input type="radio" name="BookAdd" value="no" {checkedBookAddno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="BookAdd" value="yes" {checkedBookAddyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Редактирование</span>
                                    <label>
                                        <input type="radio" name="BookEdit" value="no" {checkedBookEditno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="BookEdit" value="yes" {checkedBookEdityes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Редактирование всех книг</span>
                                    <label>
                                        <input type="radio" name="BookEditAll" value="no" {checkedBookEditAllno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="BookEditAll" value="yes" {checkedBookEditAllyes}/>
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
                                        <input type="radio" name="AuthorAdd" value="no" {checkedAuthorAddno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="AuthorAdd" value="yes" {checkedAuthorAddyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Редактирование</span>
                                    <label>
                                        <input type="radio" name="AuthorEdit" value="no" {checkedAuthorEditno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="AuthorEdit" value="yes" {checkedAuthorEdityes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Редактирование всех авторов</span>
                                    <label>
                                        <input type="radio" name="AuthorEditAll" value="no" {checkedAuthorEditAllno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="AuthorEditAll" value="yes" {checkedAuthorEditAllyes}/>
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
                                        <input type="radio" name="PrintAdd" value="no" {checkedPrintAddno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="PrintAdd" value="yes" {checkedPrintAddyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Редактирование</span>
                                    <label>
                                        <input type="radio" name="PrintEdit" value="no" {checkedPrintEditno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="PrintEdit" value="yes" {checkedPrintEdityes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Редактирование всех издательств</span>
                                    <label>
                                        <input type="radio" name="PrintEditAll" value="no" {checkedPrintEditAllno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="PrintEditAll" value="yes" {checkedPrintEditAllyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                        </fieldset>
                        <div class="clear"></div>
                        <div class="block-actions">
                            <ul class="actions-left">
                                <li>
                                    <a class="clase-toolbox button red" href="userOption.php?id={ID}&action=resetFull">Сброс настроек по умолчанию</a>
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
                <div id="tab-dolor" class="tab-content">
                    <form class="block-content form" action="userOption.php?id={ID}" method="post">
                        <input type="hidden" value="updateActions" name="action">
                        <fieldset>
                            <legend>
                                Коментарии
                            </legend>
                            <div class=_25>
                                <p>
                                    <span class="label">Просмотр</span>
                                    <label>
                                        <input type="radio" name="CommentsShow" value="no" {checkedCommentsShowno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="CommentsShow" value="yes" {checkedCommentsShowyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Отправка</span>
                                    <label>
                                        <input type="radio" name="CommentsPost" value="no" {checkedCommentsPostno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="CommentsPost" value="yes" {checkedCommentsPostyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Отправка без АнтиБот</span>
                                    <label>
                                        <input type="radio" name="CommentsPostAntiBot" value="no" {checkedCommentsPostAntiBotno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="CommentsPostAntiBot" value="yes" {checkedCommentsPostAntiBotyes}/>
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
                                        <input type="radio" name="BookShow" value="no" {checkedBookShowno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="BookShow" value="yes" {checkedBookShowyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Чтение</span>
                                    <label>
                                        <input type="radio" name="BookRead" value="no" {checkedBookReadno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="BookRead" value="yes" {checkedBookReadyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Загрузка прикрепленных файлов</span>
                                    <label>
                                        <input type="radio" name="GetFiles" value="no" {checkedGetFilesno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="GetFiles" value="yes" {checkedGetFilesyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Загрузка с АнтиБот</span>
                                    <label>
                                        <input type="radio" name="GetFilesAntiBot" value="no" {checkedGetFilesAntiBotno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="GetFilesAntiBot" value="yes" {checkedGetFilesAntiBotyes}/>
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
                                        <input type="radio" name="Search" value="no" {checkedSearchno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="Search" value="yes" {checkedSearchyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Распознавание текста</span>
                                    <label>
                                        <input type="radio" name="ReadText" value="no" {checkedReadTextno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="ReadText" value="yes" {checkedReadTextyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                            <div class=_25>
                                <p>
                                    <span class="label">Загрузка полноразмерного TIFF</span>
                                    <label>
                                        <input type="radio" name="GetFullTIFF" value="no" {checkedGetFullTIFFno}/>
                                        Запрещено</label>
                                    <label>
                                        <input type="radio" name="GetFullTIFF" value="yes" {checkedGetFullTIFFyes}/>
                                        Разрешено</label>
                                </p>
                            </div>
                        </fieldset>
                        <div class="clear"></div>
                        <div class=block-actions>
                            <ul class=actions-left>
                                <li>
                                    <a class="clase-toolbox button red" href="userOption.php?id={ID}&action=resetFull">Сброс настроек по умолчанию</a>
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
            </div>
        </div>
    </div>
    <div class="clear height-fix"></div>
</div>
