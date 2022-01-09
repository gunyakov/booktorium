<!-- Heading  -->
<div class="row-fluid">
	<div class="span12">
		<h1>Написать тикет</h1>
		<p class="lead">
			Здесь вы можете написать тикет администратору сайта об неполадках в работе и своих пожеланиях.
		</p>
	</div>
</div>
<!--  End Heading-->
<form action="tiket.php" method="post">
	<input type="hidden" name="action" value="addTiket">
	<!--  Block -->
	<div class="row-fluid">
		<div class="span12">
			<div class="form-horizontal well ">
				<legend>
					Отправить тикет
				</legend>
				<div class="control-group">
					<label class="control-label">Заголовок</label>
					<div class="controls">
						<input class="span9" type="text" name="subject" placeholder="Например: Проблема загрузки файлов" >
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Сообщение</label>
					<div class="controls">
						<textarea class="span9" rows="10" name="message" placeholder="Описание проблемы"></textarea>
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