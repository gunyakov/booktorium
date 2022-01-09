<article class="item-holder">
    <div class="span2">
        <a href="showBook.php?id={ID}"><img src="{imageName}" alt="{name}" /></a>
    </div>
    <div class="span10">
        <div class="title-bar">
            <a href="showBook.php?id={ID}">{name}</a><span>Формат: {format}</span>
        </div>
        <strong>Скачиваний: {downloadCount}</strong>
        <span class="rating-bar"><img alt="Rating Star" src="{THEME_PATH}/images/rating-star{rating}.png"></span>
        <p>
            {smallDescr}
        </p>
        <div class="cart-price">
            <a href="showBook.php?id={ID}" class="cart-btn2">Подробнее</a>
            <span class="price">Год издания: {year}</span>
        </div>
    </div>
</article>