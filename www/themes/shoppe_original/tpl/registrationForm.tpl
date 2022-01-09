<div class="heading-bar">
    <h2>Страница регистрации нового пользователя</h2>
    <span class="h-line"></span>
</div>
<section class="span9 first">
    <div class="span6 check-method-left">
        <strong class="green-t">Вспомогательные действия.</strong>
        <p>
            Если вы уже зарегестрированны, то вам <a href="login.php">сюда</a>
        </p>
        <p>
            Если вы забыли пароль, то вам <a href="forgotPassw.php">сюда</a>
        </p>
        <p align="justify">
            Регистрация на сайте проста и не занимает много времени. Мы собираем минимум информации об своих пользователях, 
            тем самым обеспечивая вашу безопасность, в случае утечки какой либо информации.
        </p>
        <p align="justify">
            Мы не ведем логи доступа к сайту. Мы не собираем ип адресса пользователей. Даже пароли мы храним в базе в виде md5 
            хешей, а это дает вам полную гарантию того, что никто, вплоть до администраторов проекта, не могут посмотреть ваш пароль.
        </p>
        <p>
            &nbsp;
        </p>
        <p>
            &nbsp;
        </p>
        <p>
            &nbsp;
        </p>
        <p>
            &nbsp;
        </p>
        <p>
            &nbsp;
        </p>
    </div>

    <div class="span5 check-method-right">
        <form method='post' action='registration.php'>
            <input type="hidden" name="action" value="post">
            <strong class="green-t">Регистрация</strong>
            <form class="form-horizontal" method="post" action="login.php">
                <div class="control-group">
                    <label class="control-label">Логин <sup>*</sup></label>
                    <div class="controls">
                        <input type="text" placeholder="" name="name">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Email адресс <sup>*</sup></label>
                    <div class="controls">
                        <input type="text" placeholder="" name="email">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Пароль <sup>*</sup></label>
                    <div class="controls">
                        <input type="password" placeholder="" name="passw">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Повторите пароль <sup>*</sup></label>
                    <div class="controls">
                        <input type="password" placeholder="" name="passw2">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">АнтиБот Код <sup>*</sup></label>
                    <div class="controls">
                        <input type="text" placeholder="" name="antiBot">
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="more-btn">
                            Отправить на сервер
                        </button>
                    </div>
                </div>
            </form>
    </div>
    <hr />
</section>