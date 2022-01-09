<!-- Start Shop by Section -->
<div class="side-holder">
    <article class="shop-by-list">
        <h2>{MENU_READ_NAME}</h2>
        <div class="side-inner-holder">
            <form action="read.php" method="get">
                <input type="hidden" name="id" value="{ID}">
                <ul class="review-f-list">
                    <li>
                        <label for="file">Выберите файл</label>
                        <select name="file" class="styled">
                            {READ_FILE_CONTENT}
                        </select>
                    </li>
                    <li>
                        <label for="file">Номер страницы</label>
                        <input type="text" name='page' value="" placeholder="номер страницы...">
                    </li>
                </ul>
                <button type="submit" class="btn">
                    Перейти
                </button>
            </form>
        </div>
    </article>
</div>
<!-- End Shop by Section -->