<!-- Heading  -->
<div class="row-fluid">
	<div class="span12">
		<h1>Магический создатель изображений</h1>
		<p class="lead">
			Автоматическое создание предпросмотра к книге из файлов в формате djvu и pdf.
		</p>
	</div>
</div>

<form action="authorAdd.php" method="post">
	<input type="hidden" name="action" value="addAuthor">
	<!--  Block -->
	<div class="row-fluid">
		<div class="span12">
			<div class="controls">

			</div>
			<div class="form-horizontal well ">
				<legend>
					Список файлов
				</legend>
				<div class="control-group">
					<label class="control-label"> </label>
					<div class="controls">
						<div class="span-12 alert alert-info" style="margin-top:40px; width: 80%;">
							<p class="prepend-top append-0">
								<b>Внимание: </b> Будет произведенно удаление всех существующих записей в БД и создание новых изображений.
							</p>
						</div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Имя файла</label>
					<div class="controls">
						<input type="hidden" name="id" value="{ID}">
						<select name="fileID">
							{FILE_LIST_CONTENT}
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Кол-во цветов</label>
					<div class="controls">
						<select name="colors">
							<option value="0">По умолчанию</option>
							<option value="16">16 (черно-белое)</option>
							<option value="256">256 (цветное)</option>
						</select>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- End Block -->

	<!--  Save Button -->
	<button type="submit" class="btn btn-success pull-right">
		Создать
		<icon class="icon-check icon-white-t"></icon>
	</button>
	<!-- End Save Button  -->

	</div>
</form>
<!-- End Form  -->