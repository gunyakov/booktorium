<div class="heading-bar">
    <h2>Страница авторизации</h2>
    <span class="h-line"></span>
</div>
<section class="span9 first">
<div class="span6 check-method-left">
    <strong class="green-t">Вспомогательные действия.</strong>
    <p>
        Если вы еще не зарегестрированны, то вам <a href="registration.php">сюда</a>
    </p>
    <p>
        Если вы забыли пароль, то вам <a href="forgotPassw.php">сюда</a>
    </p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</div>
<div class="span5 check-method-right">
    <strong class="green-t">Авторизация</strong>
    <p>
        Уже зарегестрированны? Тогда добро пожаловать:
    </p>
    <form class="form-horizontal" method="post" action="login.php">
        <div class="control-group">
            <label class="control-label" for="inputEmail">Email адресс <sup>*</sup></label>
            <div class="controls">
                <input type="text" id="inputEmail" placeholder="" name="login">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputPassword">Пароль <sup>*</sup></label>
            <div class="controls">
                <input type="password" id="inputPassword" placeholder="" name="passw">
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