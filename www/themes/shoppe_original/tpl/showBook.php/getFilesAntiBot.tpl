<h3>Получить ссылку на файлы</h3>
<div id="linkContent">
    <form action='getFiles.php' method='get' id="formLink">
        <ul class="review-f-list">
            <input name="id" value="{ID}" type="hidden">
            <li>
                <label>АнтиБот Код</label>
                <input type="text" name="antiBot" value="" class="input-mini">
                <img src="extra/antiBot.php?red=255&green=255&blue=255">
            </li>
        </ul>
        <button type="submit" class="grey-btn left-btn" id="getLink">
            Отправить на сервер
        </button>
    </form>
</div>
