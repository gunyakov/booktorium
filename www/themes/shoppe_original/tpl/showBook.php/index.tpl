<section class="span9 first">
    <!-- Strat Book Detail Section -->
    <section class="b-detail-holder">
        <article class="title-holder">
            <div class="span9">
                <h4><strong>{name}</strong></h4>
            </div>
        </article>
        <div class="book-i-caption">
            <!-- Strat Book Image Section -->
            <div class="span6 b-img-holder">
                <span class='zoom' id='ex1'> <img src="{imageName}" height="219" width="300" id='jack' alt=''/></span>
            </div>
            <!-- Strat Book Image Section -->

            <!-- Strat Book Overview Section -->
            <div class="span6">
                <strong class="title">Аннотация</strong>
                <p align="justify">
                    {smallDescr}
                </p>
                <p>
                    Авторы: {AUTHOR_CONTENT}
                </p>
                <p>
                    Категории: {CATEGORY_CONTENT}
                </p>
                <p>
                    <h4 class="title">Формат: <strong>{format}</strong></h4>
                </p>
                <p>
                    <form action="read.php" method="get">
                        <input type="hidden" name="id" value="{ID}" />
                        <input name="" type="submit" value="Читать ОнЛайн" />
                    </form>
                </p>
                <br />
            </div>
            <div class="span6">
                    <div class="share42init"></div>
            </div>
            <!-- End Book Overview Section -->
        </div>

        <!-- Start Book Summary Section -->
        <div class="tabbable">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#pane1" data-toggle="tab">Описание</a>
                </li>
                <li>
                    <a href="#pane2" data-toggle="tab">Дополнительно</a>
                </li>
                <li>
                    <a href="#pane4" data-toggle="tab">Загрузить</a>
                </li>
                <li>
                    <a href="#pane3" data-toggle="tab">Предпросмотр</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="pane1" class="tab-pane active">
                    <p align="justify">
                        {descr}
                    </p>
                </div>
                <div id="pane2" class="tab-pane">
                    <p>
                        <h4>Издательство: </h4>{printName}
                    </p>
                    <p>
                        <h4>Город: </h4>{city}
                    </p>
                    <p>
                        <h4>Год издания: </h4>{year}
                    </p>
                    <p>
                        <h4>Прочитано страниц: </h4>{readCount}
                    </p>

                    <p>
                        <h4>Распознаных страниц: </h4>{readTextCount}
                    </p>
                    <p>
                        <h4>Количество загрузок: </h4>{downloadCount}
                    </p>
                    <p>
                        <h4>Размер файлов: </h4>{fileSize}
                    </p>
                </div>
                <div id="pane4" class="tab-pane">
                    <div class="span6 check-method-left">
                        <p align="justify">
                            Файлы для скачивания доступны в течении 4х часов после создания ссылок.
                        </p>
                        <p align="justify">
                            Не закрывайте это окно до окончания скачивания, иначе вам прийдется заново делать запрос на файлы.
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

                        {GET_FILES_CONTENT}
                    </div>
                </div>
                <div id="pane3" class="tab-pane">
                    <div class="row-fluid">
                        {IMAGE_CONTENT}
                    </div>
                </div>
            </div><!-- /.tab-content -->
        </div><!-- /.tabbable -->
        <!-- End Book Summary Section -->
        <!-- Stsrt Customer Reviews Section -->
        <section class="reviews-section">
            <figure class="left-sec">
                <div class="r-title-bar">
                    <strong>Отзывы</strong>
                </div>
                <ul class="review-list">
                    {MESSAGE_CONTENT}
                </ul>
                <div class="blog-footer" align="center">
                    {PAGINATION_CONTENT}
                </div>
            </figure>
            <figure class="right-sec">
                <div class="r-title-bar">
                    <strong>Написать собственный отзыв</strong>
                </div>
                {COMMENT_FORM}
            </figure>
        </section>
        <!-- End Customer Reviews Section -->
    </section>
</section>