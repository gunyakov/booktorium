<div class=container_12>

    <div class=grid_12>

        <div class=block-border>
            <div class=block-header>
                <h1>Информация об категории</h1><span></span>
            </div>
            <form class="block-content form" action="categoryList.php" method="post">
                <input type="hidden" value="updateCategory" name="action">
                <input type="hidden" value="{ID}" name="id">
                <div class=_25>
                    <p>
                        <label for=textfield>Имя категории</label>
                        <input name="name" class=required type="text" value="{name}"/>
                    </p>
                </div>
                <div class=_50>
					<p>
						<label for=textfield>Описание</label>
						<input id="descr" name="descr" class=required type="text" value="{descr}"/>
					</p>
				</div>
                <div class=_25>
                    <p>
                        <label>Родительская категория</label>
                        <select name="parentID" id="parentID">
                            <option value=0>Root</option>
                            {SELECT_CATEGORY_CONTENT}
                        </select>
                    </p>
                </div>
                <div class="clear"></div>
                <div class=block-actions>
                    <ul class=actions-left>
                        <li>
                            <a class="button red" id=reset-validate-form href="javascript:void(0);">Сброс</a>
                        </li>
                    </ul>
                    <ul class=actions-right>
                        <li>
                            <input type="submit" class=button value="Отправить на сервер">
                        </li>
                    </ul>
                </div>
            </form>
        </div>
    </div>
</div>