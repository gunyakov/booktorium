<div class=container_12>
    <div class=grid_12>
        <div class=block-border>
            <div class=block-header>
                <h1>{LANG_USER_INFORMATION_TITLE}</h1>
            </div>
            <form class="block-content form" action="userList.php?id={ID}" method="post">
                <input type="hidden" value="updateUserInfo" name="action">
                <fieldset>
                    <legend>
                        Главный раздел
                    </legend>
                    <div class=_50>
                        <p>
                            <label>Имя пользователя</label>
                            <input name="name" type="text" value="{name}"/>
                        </p>
                    </div>
                    <div class=_25>
                        <p>
                            <label>Е-Мейл</label>
                            <input name="email" type="text" value="{email}"/>
                        </p>
                    </div>
                    <div class=_25>
                        <p>
                            <label>Подтвержден ли е-мейл</label>
                            <select name="emailConfirm">
                                <option value="no">Нет</option>
                                <option value="yes">Да</option>
                            </select>
                        </p>
                        Значение в БД: {LANG_EMAIL_{emailConfirm}}
                    </div>
                </fieldset>
                <fieldset>
                    <legend>
                        Дополнительный раздел
                    </legend>
                    <div class=_50>
                        <p class=inline-small-label>
                            <label>Новый пароль</label>
                            <input name="passw" type="text" value="" class=""/>
                        </p>
                    </div>
                    <br class='clear'>
                    <div class=_50>
                        <p class=inline-small-label>
                            <label>Дата регистрации</label>
                            <input name="dateRegistration" type="text" value="{dateRegistration}" class="datepicker"/>
                        </p>
                    </div>
                    <br class='clear'>
                    <div class=_50>
                        <p class=inline-small-label>
                            <label>Последний визит</label>
                            <input name="lastLogin" type="text" value="{lastLogin}" class="datepicker"/>
                        </p>
                    </div>
                    <br class='clear'>
                    <div class=_50>
                        <p class=inline-small-label>
                            <label>Репутация</label>
                            <input name="amount" type="text" value="{amount}"/>
                        </p>
                    </div>
                    <br class='clear'>
                    <div class=_50>
                        <p class=inline-small-label>
                            <label>Статус</label>
                            <select name="state">
                                <option value="user">Пользователь</option>
                                <option value="moderator">Модератор(отключено)</option>
                                <option value="administrator">Администратор</option>
                            </select>
                            Значение в БД: {LANG_{state}}
                        </p>
                    </div>
                    <br class='clear'>
                    <div class=_50>
                        <p class=inline-small-label>
                            <label>Доступ к сайту</label>
                            <select name="ban">
                                <option value="no">Резрешен</option>
                                <option value="yes">Запрещен</option>
                            </select>
                           Значение в БД: {LANG_BAN_{ban}}
                        </p>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>
                        Премиум
                    </legend>
                    <div class=_50>
                        <p class=inline-small-label>
                            <label>Окончание</label>
                            <input type="text" name="datePremium" value="{datePremium}" class="datepicker">
                        </p>
                    </div>
                    <br class="clear">
                    <div class=_50>
                        <p class=inline-small-label>
                            <label>Бонусн месяца</label>
                            <input type="text" name="freePremium" value="{freePremium}">
                        </p>
                    </div>
                </fieldset>
                <div class=block-actions>
                    <ul class=actions-left>
                        <li>
                            <a class="close-toolbox button red" href="javascript:void(0);">Сброс</a>
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
    <div class="clear height-fix"></div>
</div>
