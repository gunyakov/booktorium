<div class="heading-bar">
    <h2>Кабинет</h2>
    <span class="h-line"></span>
</div>
<section class="span9 first">
    <div class="tabbable">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#pane1" data-toggle="tab">Сменить логин</a>
            </li>
            <li>
                <a href="#pane2" data-toggle="tab">Сменить пароль</a>
            </li>
            <li>
                <a href="#pane4" data-toggle="tab">Дополнительно</a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="pane1" class="tab-pane active">
                <div class="span5 check-method-right">
                    <form action="cabinet.php?mod=profile" method="post" class="form-horizontal">
                        <input type="hidden" name="action" value="data">
                        <div class="control-group">
                            <label class="control-label">Новый логин <sup>*</sup></label>
                            <div class="controls">
                                <input type="text" placeholder="" name="name" value="{name}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Новый email <sup>*</sup></label>
                            <div class="controls">
                                <input type="text" placeholder="" name="email" value="{email}">
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
            </div>
            <div id="pane2" class="tab-pane">
                <form action="cabinet.php?mod=profile" method="post" class="form-horizontal">
                    <input type="hidden" name="action" value="password">
                    <div class="span5 check-method-right">
                        <div class="control-group">
                            <label class="control-label">Старый пароль <sup>*</sup></label>
                            <div class="controls">
                                <input type="password" placeholder="" name="passw">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Новый пароль <sup>*</sup></label>
                            <div class="controls">
                                <input type="password" placeholder="" name="new_passw">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Повторите пароль <sup>*</sup></label>
                            <div class="controls">
                                <input type="password" placeholder="" name="reenter_passw">
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="more-btn">
                                    Отправить на сервер
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div id="pane4" class="tab-pane">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Название счетчика</th>
                            <th>Значения</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Репутация :</td>
                            <td> &nbsp;&nbsp; {amount} </td>
                        </tr>
                        <tr>
                            <td>Регистрация :</td>
                            <td> &nbsp;&nbsp; {dateRegistration} </td>
                        </tr>
                        <tr>
                            <td>Подтверждение Е-Мейл :</td>
                            <td> &nbsp;&nbsp; {emailConfirm} </td>
                        </tr>
                        <tr>
                            <td>Последний визит :</td>
                            <td> &nbsp;&nbsp; {lastLogin} </td>
                        </tr>
                        <tr>
                            <td>Коментариев :</td>
                            <td> &nbsp;&nbsp; {CurrentCountCommentsPost} из  {LimitCommentsPost}, {AmountCommentsPost} за первые {CountCommentsPost}</td>
                        </tr>
                        <tr>
                            <td>Страниц :</td>
                            <td> &nbsp;&nbsp; {CurrentCountReadImage} из {LimitReadImage}, {AmountReadImage} за первые {CountReadImage}</td>
                        </tr>
                        <tr>
                            <td>Распознаных страниц :</td>
                            <td> &nbsp;&nbsp; {CurrentCountReadText} из {LimitReadText}, {AmountReadText} за первые {CountReadText}</td>
                        </tr>
                        <tr>
                            <td>Загруженых файлов :</td>
                            <td> &nbsp;&nbsp; {CurrentCountGetFiles} из {LimitGetFiles}, {AmountGetFiles} за первые {CountGetFiles}</td>
                        </tr>
                        <tr>
                            <td>Входа на сайт :</td>
                            <td> &nbsp;&nbsp; {CurrentCountLogin} из {LimitLogin}, {AmountLogin} за первые {CountLogin}</td>
                        </tr>
                        <tr>
                            <td>Загрузка полнормазмерных TIFF :</td>
                            <td> &nbsp;&nbsp; {CurrentCountGetFullTIFF} из {LimitGetFullTIFF}, {AmountGetFullTIFF} за первые {CountGetFullTIFF}</td>
                        </tr>
                        <tr>
                            <td>Поисковые запросы :</td>
                            <td> &nbsp;&nbsp; {CurrentCountSearch} из {LimitSearch}, {AmountSearch} за первые {CountSearch}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div><!-- /.tab-content -->
    </div><!-- /.tabbable -->
</section>