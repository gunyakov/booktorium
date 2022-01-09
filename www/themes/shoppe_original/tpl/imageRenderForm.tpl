<div class="heading-bar">
    <h2>Кабинет -> Опции вывода страниц</h2>
    <span class="h-line"></span>
</div>
<section class="span9 first">
    <div class="span6 check-method-left">
        <p align="justify">
            Рекомендуется не менять параметры вывода страниц. Значения по умолчанию дают максимальное сжатие при достаточно четком отображении текста. Изменение данных параметров может привести к увеличению размера страницы из книги, что скажется на скорости загрузки страницы и увеличеному расходу трафика.
        </p>
        <p align="justify">
            * - формат JPEG не поддерживает прозрачный фон. В случае выбора формата JPEG и прозрачного фона вы получите полность черную страницу. Система пока не обрабатывает этот взаимоисключающий выбор.
        </p>
        <p align="justify">
            ** - прозрачный фон будет коректно формироваться только в монохромных изображениях.
        </p>
        <p align="justify">
            *** - в случае установки монохромного изображения, в данном поле вы указываете количество оттенков серого, доступного для формирования страницы. В случае выбора цветного изображения, вы устанавливаете количество доступных цветов для формирования страницы. Формат GIF разрешает использовать максимально 256 цветов.
        </p>
    </div>
    <div class="span5 check-method-right">

        <form action="cabinet.php?mod=image" method="post">
            <input type="hidden" name="action" value="data">
            <div class="control-group">
                <label class="control-label">Формат изображения (рекомендуется png): <sup>*</sup></label>
                <div class="controls">
                    <select name='format'>
                        <option value="png">PNG</option>
                        <option value="gif">GIF</option>
                        <option value="jpg">JPEG</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Цветность изображения (рекомендуется монохромное):</label>
                <div class="controls">
                    <select name='monochrome'>
                        <option value="true">Монохромное</option>
                        <option value="false">Цветное</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Фон изображения (рекомендуется прозрачный): <sup>**</sup></label>
                <div class="controls">
                    <select name='transparent'>
                        <option value="true">Прозрачный</option>
                        <option value="false">Белый</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Количество цветов (рекомендуется 16): <sup>***</sup></label>
                <div class="controls">
                    <input type="text" name="colors" value="16">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Разрешение экрана пользователя:</label>
                <div class="controls">
                    <select name='resize' class="styled-input">
                        <option value="794">1366 x 768</option>
                    </select>
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