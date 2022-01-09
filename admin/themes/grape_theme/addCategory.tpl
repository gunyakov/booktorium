<div class=container_12>

	<div class=grid_12>

		<div class=block-border>
			<div class=block-header>
				<h1>Добавить новую категорию</h1><span></span>
			</div>
			<form class="block-content form" action="addCategory.php" method="post">
				<input type="hidden" value="post" name='action'>
				<div class=_25>
					<p>
						<label for=textfield>Имя категории</label>
						<input id="categoryName" name="categoryName" class=required type="text" value=""/>
					</p>
				</div>
				<div class=_50>
					<p>
						<label for=textfield>Описание</label>
						<input id="categoryDescr" name="categoryDescr" class=required type="text" value=""/>
					</p>
				</div>
				<div class=_25>
					<p>
						<label>Родительская категория</label>
						<select name="parentID" id="parentID">
							<option value="-1">Root</option>
							{SELECT_CATEGORY_CONTENT}
						</select>
					</p>
				</div>
				<div class=clear></div>
				<div class=block-actions>
					<ul class=actions-left>
						<li>
							<a class="button red" id=reset-validate-form href="javascript:void(0);">Сброс</a>
						</li>
					</ul>
					<ul class=actions-right>
						<li>
							<input type=submit class=button value="Отправить на сервер">
						</li>
					</ul>
				</div>
			</form>
		</div>
	</div>
</div>