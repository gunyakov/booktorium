<div class=container_12>

    <div class=grid_12>

        <div class=block-border>
            <div class=block-header>
                <h1>Устранение проблем</h1><span></span>
            </div>
            <form class="block-content form" action="fixProblem.php" method="post">
                <div class=_50>
                    <p>
                        <label>Проверить и устранить проблемы</label>
                        <select name="action">
                            <option value="fixFileInStorage">соответсвие записей в БД локальным файлам</option>
                            <option value="fixFileLink">соответствие ссылок файлов книгам</option>
                            <option value="fixFileInDB">соответствие файлов записям в БД</option>
                            <option value="fixImageInStorage">соответсвие записей в БД локальным изображениям</option>
                            <option value="fixImageLink">соответствие ссылок изображений книгам</option>
                            <option value="fixImageInDB">соответствие изображений записям в БД</option>
                            <option value="fixAuthor">авторах</option>
                            <option value="fixPrint">издательствах</option>
                        </select>
                    </p>
                </div>
                <div class=clear></div>
                <div class=block-actions>
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