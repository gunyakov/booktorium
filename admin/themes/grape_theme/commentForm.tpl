<div class=container_12>

    <div class=grid_12>

        <div class=block-border>
            <div class=block-header>
                <h1>Коментарий</h1><span></span>
            </div>
            <form class="block-content form" action="comments.php?id={ID}" method="post">
                <div class=_100>
                    <p>
                        <label for=textfield>Сообщение</label>
                        {message}
                    </p>
                </div>
                <div class=_25>
                    <p>
                        <label>Событие</label>
                        <select name="action">
                            <option value="approve">Утвердить</option>
                            <option value="delComment">Удалить</option>
                            <option value="delAndBan">Удалить и забанить пользователя</option>
                        </select>
                    </p>
                </div>
                <div class="clear"></div>
                <div class=block-actions>
                    <ul class=actions-left>
                        <li>
                            <a class="button red" id=reset-validate-form href="javascript:void(0);">Сброс</a>
                        </li>
                    </ul>
                    <ul class=actions-right>
                        <li>
                            <input type="submit" class=button value="Отправить на сервер">
                        </li>
                    </ul>
                </div>
            </form>
        </div>
    </div>
</div>