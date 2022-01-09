<!-- Heading  -->
<div class="row-fluid">
	<div class="span12">
		<h1>Добавить автора</h1>
		<p class="lead">
			Здесь вы можете добавить новую запись об авторе в БД.
		</p>
	</div>
</div>
<!--  End Heading-->

<form action="authorAdd.php" method="post">
	<input type="hidden" name="action" value="addAuthor">
	<!--  Block -->
	<div class="row-fluid">
		<div class="span12">
			<div class="form-horizontal well ">
				<legend>
					Данные об авторе
				</legend>
				<div class="control-group">
					<label class="control-label">Фамилия</label>
					<div class="controls">
						<input class="span5" type="text" name="familyName" placeholder="Например: Гуняков">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Инициалы</label>
					<div class="controls">
						<input class="span5" type="text" name="name" placeholder="Например: О.С">
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