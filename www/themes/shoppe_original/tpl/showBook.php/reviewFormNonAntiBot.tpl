<form action="showBook.php?id={ID}" method="post">
    <ul class="review-f-list">
        <li>
            <label>Ваше имя *</label>
            <input name="userName" type="text" />
        </li>
        <li>
            <label>Ваш отзыв *</label>
            <textarea name="message" cols="2" rows="20"></textarea>
        </li>
        <li>
            <label>На сколько вы оцениваете данную книгу? *</label>
            <div class="rating-list">
                <div class="rating-box">
                    <label class="radio">
                        <input type="radio" name="rating" value="1" checked>
                        <img src="{THEME_PATH}/images/rating-star10.png"> </label>
                </div>
                <label class="radio">
                    <input type="radio" name="rating" value="2">
                    <img src="{THEME_PATH}/images/rating-star20.png"> </label>
                <label class="radio">
                    <input type="radio" name="rating" value="3">
                    <img src="{THEME_PATH}/images/rating-star30.png"> </label>
                <label class="radio">
                    <input type="radio" name="rating" value="4">
                    <img src="{THEME_PATH}/images/rating-star40.png"> </label>
                <label class="radio">
                    <input type="radio" name="rating" value="5">
                    <img src="{THEME_PATH}/images/rating-star50.png"> </label>
            </div>
        </li>
    </ul>
    <button type="submit" class="grey-btn left-btn">Отправить на сервер</button>
</form>