<div class="heading-bar">
    <h2>Поиск книги</h2>
    <span class="h-line"></span>
</div>
<section class="span9 first">
    <div class="span6 check-method-left">
        <strong class="green-t">Дополнительные сведения</strong>
        <p>
            Во время поиска вы можете пользоваться специальными символами.
        </p>
        <p>
            Символ ? заменяет любой один символ. Символ % заменяет любое количество символов.
        </p>
        <p align="justify">
            Например: вам надо найти человека с фамилией Николаев. Но вы не уверенны точно НиколАев он или 
            НиколЯев. Для этого в поисковой строке наберите Никол?ев. Так же вы можете набрать Никол%, тем самым сообщив 
            серверу, что надо искать всех авторов, фамилии которых начинаются с Никол.
        </p>
    </div>
    <div class="span5 check-method-right">
        <strong class="green-t">Поиск</strong>
        <form class="form-horizontal" method="post" action="search.php">
            <div class="control-group">
                <label class="control-label" for="inputEmail">Поисковая строка <sup>*</sup></label>
                <div class="controls">
                    <input type="text" placeholder="" name="search">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Искать в </label>
                <div class="controls">
                    <select name='option'>
                        <option value="author">авторах</option>
                        <option value="name">названии книги</option>
                        <option value="descr">описании</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="more-btn2">
                        Отправить на сервер
                    </button>
                </div>
            </div>
        </form>
    </div>
    <hr />
</section>