<div class=container_12>

    <div class=grid_12>

        <div class=block-border>
            <div class=block-header>
                <h1>Утвердить книгу</h1><span></span>
            </div>
            <form class="block-content form" action="bookList.php?id={ID}" method="post">
                <fieldset>
                    <legend>
                        Информация
                    </legend>
                    <div class=_100>
                        <p>
                            <label for=textfield>Название</label>
                        <p>
                            {name}
                        </p>
                        </p>
                    </div>
                    <div class=_100>
                        <p>
                            <label>Анотация</label>
                        <p>
                            {smallDescr}
                        </p>
                        </p>
                    </div>
                    <div class=_100>
                        <p>
                            <label>Описание</label>
                        <p>
                            {descr}
                        </p>
                        </p>
                    </div>
                    <div class=_25>
                        <p>
                            <label>Формат</label>
                        <p>
                            {format}
                        </p>
                        </p>
                    </div>
                    <div class=_25>
                        <p>
                            <label>Год издания</label>
                        <p>
                            {year}
                        </p>
                        </p>
                    </div>
                    <div class=_50>
                        <p>
                            <label>Дата добавления</label>
                        <p>
                            {datePut}
                        </p>
                        </p>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>
                        Автора
                    </legend>
                    {AUTHOR_CONTENT}
                </fieldset>
                <fieldset>
                    <legend>
                        Категории
                    </legend>
                    {CATEGORY_CONTENT}
                </fieldset>
                <fieldset>
                    <legend>
                        Издательство
                    </legend>
                    {PRINT_CONTENT}
                </fieldset>
                <fieldset>
                    <legend>
                        Файлы
                    </legend>
                    {FILE_CONTENT}
                </fieldset>
                <fieldset>
                    <legend>
                        Изображения
                    </legend>
                    {IMAGE_CONTENT}
                </fieldset>
                <fieldset>
                    <legend>
                        Доп данные
                    </legend>
                    {EXTRA_BLOCKS_CONTENT}
                </fieldset>
                <fieldset>
                    <legend>
                        Событие
                    </legend>
                    <div class=_25>            
                        <p>
                            <select name="action">
                                <option value="putToList">Добавить в очередь</option>
                                <option value="approved">Утвердить</option>
                                <option value="returnToEdit">Вернуть на доработку</option>
                            </select>
                        </p>    
                    </div>
                </fieldset>
                <div class=clear></div>
                <div class=block-actions>
                    <ul class=actions-left>
                        <li>
                            <a class="button red" id=reset-validate-form href="javascript:void(0);">Сброс</a>
                        </li>
                    </ul>
                    <ul class=actions-right>
                        <li>
                            <input type=submit class=button value="Отправить на сервер">
                        </li>
                    </ul>
                </div>
            </form>
        </div>
    </div>
</div>