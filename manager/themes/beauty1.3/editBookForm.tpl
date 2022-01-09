<div class="row-fluid">
	<div class="span12">
		<div class="form-horizontal well">
			<legend>
				Список авторов
			</legend>
			<div class="control-group" id="authorContent">
				{AUTHOR_CONTENT}
			</div>
			<hr>
			<div class="control-group">
				<label class="control-label">Привязать нового автора</label>
				<div class="controls">
					<form action="author.php" method="post" id="addAuthorForm">
						<input type="hidden" name="bookID" value="{ID}" id="bookID">
						<input type="hidden" name="action" value="addToBook">
						<select name="authorID" id="authorList">
							{AUTHOR_LIST_CONTENT}
						</select>
						<button type="submit" class="btn btn-add-page btn-primary" value="add">
							<icon class="icon-plus icon-white"></icon>
							Добавить привязку
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<div class="form-horizontal well ">
			<legend>
				Список категорий
			</legend>
			<div class="control-group" id="categoryContent">
				{CATEGORY_CONTENT}
			</div>
			<hr>
			<div class="control-group">
				<label class="control-label">Привязать новую категорию</label>
				<div class="controls">
					<form action="category.php" method="post" id="addCategoryForm">
						<input type="hidden" name="bookID" value="{ID}">
						<input type="hidden" name="action" value="addToBook">
						<select name="categoryID">
							{CATEGORY_LIST_CONTENT}
						</select>
						<button type="submit" class="btn btn-add-page btn-primary" value="add">
							<icon class="icon-plus icon-white"></icon>
							Добавить привязку
						</button>
					</form>
				</div>
			</div>
		</div>

	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<div class="form-horizontal well ">
			<legend>
				Список файлов
			</legend>
			<div class="control-group">
				<label class="control-label">&nbsp;</label>
				<div class="controls">
					<div class="span-12 alert alert-info" style="margin-top:40px; width: 80%;">
						<p class="prepend-top append-0">
							<b>Внимание: </b> удаление привязки приводит к физическому удалению файла из папки хранения.
						</p>
					</div>
				</div>
			</div>
			<div class="control-group" id="fileContent">
				{FILE_CONTENT}
			</div>
			<hr>
			<div class="control-group">
				<!--  Tabs -->

				<label class="control-label">Привязать файл</label>
				<div class="controls">
					<div class="tabbable tabs-left">

						<!--  Tabs Menu -->
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#lA" data-toggle="tab">локальный</a>
							</li>
							<li>
								<a href="#lB" data-toggle="tab">удаленный</a>
							</li>
						</ul>
						<!-- End Tab Menu  -->
						<!--  Tab Content -->
						<div class="tab-content">

							<!--  Tab Content Block -->
							<div class="tab-pane active" id="lA">
								<form action="file.php" method="post">
									<input type="hidden" name="bookID" value="{ID}">
									<input type="hidden" name="action" value="addToBook">
									<div class="control-group">
										<label class="control-label">Имя файла</label>
										<div class="controls">
											<select name="localFileName">
												{FILE_LIST_CONTENT}
											</select>
										</div>
									</div>
									<br>
									<div class="control-group">
										<label class="control-label">Формат файла</label>
										<div class="controls">
											<select name="fileFormat">
												<option value="etc">etc</option>
												<option value="djvu">djvu</option>
												<option value="pdf">pdf</option>
												<option value="txt">txt</option>
											</select>
										</div>
									</div>
									<br>
									<div class="control-group">
										<label class="control-label">Кол-во страниц</label>
										<div class="controls">
											<input type="text" name="pages" placeholder="Pages">

										</div>
									</div>
									<button type="submit" class="btn btn-add-page btn-primary" value="add">
										<icon class="icon-plus icon-white"></icon>
										Добавить привязку
									</button>
								</form>
							</div>
							<!--  Tab Content Block -->
							<div class="tab-pane" id="lB">
								<form action="file.php" method="post">
									<input type="hidden" name="bookID" value="{ID}">
									<input type="hidden" name="action" value="addToBook">

									<div class="control-group">
										<label class="control-label">Имя файла</label>
										<div class="controls">
											<input type="text" name="remoteFileName">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Формат файла</label>
										<div class="controls">
											<select name="fileFormat">
												<option value="etc">etc</option>
												<option value="djvu">djvu</option>
												<option value="pdf">pdf</option>
												<option value="txt">txt</option>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Кол-во страниц</label>
										<div class="controls">
											<input type="text" name="pages" placeholder="Pages">

										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Размер файла</label>
										<div class="controls">
											<input type="text" name="fileSize" placeholder="Bytes">

										</div>
									</div>
									<button type="submit" class="btn btn-add-page btn-primary" value="add">
										<icon class="icon-plus icon-white"></icon>
										Добавить привязку
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<a href="fileManager.php">Менеджер файлов</a>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<div class="form-horizontal well ">
			<legend>
				Список изображений
			</legend>
			<div class="control-group" id="imageContent">
				{IMAGE_CONTENT}
			</div>
			<hr>
			<div class="control-group">
				<!--  Tabs -->

				<label class="control-label">Привязать изображение</label>
				<div class="controls">
					<div class="tabbable tabs-left">

						<!--  Tabs Menu -->
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#lC" data-toggle="tab">локальный</a>
							</li>
							<li>
								<a href="#lE" data-toggle="tab">удаленный</a>
							</li>
						</ul>
						<!-- End Tab Menu  -->
						<!--  Tab Content -->
						<div class="tab-content">

							<!--  Tab Content Block -->
							<div class="tab-pane active" id="lC">
								<form action="image.php" method="post">
									<input type="hidden" name="bookID" value="{ID}">
									<input type="hidden" name="action" value="addToBook">
									<div class="control-group">
										<label class="control-label">Имя изображения</label>
										<div class="controls">
											<select name="localImageName">
												{IMAGE_LIST_CONTENT}
											</select>
										</div>
									</div>
									<button type="submit" class="btn btn-add-page btn-primary" value="add">
										<icon class="icon-plus icon-white"></icon>
										Добавить привязку
									</button>
								</form>
							</div>
							<!--  Tab Content Block -->
							<div class="tab-pane" id="lE">
								<form action="image.php" method="post">
									<input type="hidden" name="bookID" value="{ID}">
									<input type="hidden" name="action" value="addToBook">

									<div class="control-group">
										<label class="control-label">Имя изображения</label>
										<div class="controls">
											<input type="text" name="remoteImageName">
										</div>
									</div>
									<button type="submit" class="btn btn-add-page btn-primary" value="add">
										<icon class="icon-plus icon-white"></icon>
										Добавить привязку
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<a href="imageMagick.php?id={ID}">Магический создатель изображений</a>
	</div>
</div>

<div class="row-fluid">
	<div class="span12">
		<div class="form-horizontal well ">
			<legend>
				Список издательств
			</legend>
			<div class="control-group" id="printContent">
				{PRINT_CONTENT}
			</div>
			<hr>
			<div class="control-group">
				<label class="control-label">Привязать новое издательство</label>
				<div class="controls">
					<form action="print.php" method="post">
						<input type="hidden" name="bookID" value="{ID}">
						<input type="hidden" name="action" value="addToBook">
						<select name="printID">
							{PRINT_LIST_CONTENT}
						</select>
						<button type="submit" class="btn btn-add-page btn-primary" value="add">
							<icon class="icon-plus icon-white"></icon>
							Добавить привязку
						</button>
					</form>
				</div>
			</div>
		</div>

	</div>
</div>
<form action="bookUpdate.php" method="post">
	<!--  Block -->
	<div class="row-fluid">
		<div class="span12">
			<input type="hidden" name="id" value="{ID}">
			<div class="form-horizontal well ">
				<legend>
					Данные о книге
				</legend>
				<div class="control-group">
					<label class="control-label">Название</label>
					<div class="controls">
						<input class="span10" type="text" name="name" placeholder="keyword1 keyword2 other" value="{name}">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Аннотация</label>
					<div class="controls">
						<textarea class="span9" rows="3" name="smallDescr" placeholder="Content goes here">{smallDescr}</textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Описание</label>
					<div class="controls">
						<textarea class="span9" rows="10" name="descr" placeholder="Content goes here">{descr}</textarea>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="inputEmail">Год издательства</label>
					<div class="controls">
						<input type="text" name="year" value="{year}">
					</div>
				</div>
				{EXTRA_BLOCKS_CONTENT}
				<div class="control-group">
					<label class="control-label" for="inputEmail">Оформление закончено</label>
					<div class="controls">
						<select name="approved" value="{format}">
							<option value="finish">Да</option>
							<option value="no" selected>Нет</option>
						</select>
					</div>
				</div>
			</div>

		</div>
		<!-- End Block -->

		<!--  Save Button -->
		<button type="submit" class="btn btn-success pull-right">
			Отправить на сервер
			<icon class="icon-check icon-white-t"></icon>
		</button>
		<!-- End Save Button  -->

	</div>
</form>
<!-- End Form  -->