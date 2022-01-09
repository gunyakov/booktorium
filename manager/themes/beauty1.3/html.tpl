<!DOCTYPE html>
<html>
	<head>
		<title>ДУБ 2.0b - Книжный менеджер.</title>

		<!-- Bootstrap -->
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="{THEME_PATH}/bootstrap/css/bootstrap.min.css" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="{THEME_PATH}/bootstrap/css/bootstrap-responsive.min.css" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">

		<!-- Bootstrap Extended -->
		<link href="{THEME_PATH}/bootstrap/extend/jasny-bootstrap/css/jasny-bootstrap.min.css" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/bootstrap/extend/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
		<link href="{THEME_PATH}/bootstrap/extend/jasny-bootstrap/css/jasny-bootstrap-responsive.min.css" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/bootstrap/extend/jasny-bootstrap/css/jasny-bootstrap-responsive.min.css" rel="stylesheet">
		<!-- wysihtml5 -->
		<link href="{THEME_PATH}/bootstrap/extend/bootstrap-wysihtml5/css/bootstrap-wysihtml5-0.0.2.css" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/bootstrap/extend/bootstrap-wysihtml5/css/bootstrap-wysihtml5-0.0.2.css" rel="stylesheet">

		<!-- Theme :: Beauty Admin  -->
		<link href="{THEME_PATH}/theme/css/beautyadmin.css" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/theme/css/beautyadmin.css" rel="stylesheet">

		<!--  Google Open Sans Font -->
		<link href="http://fonts.googleapis.com/css-family=Open+Sans-400,300,600,700&subset=latin,latin-ext.css" tppabs="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=latin,latin-ext" rel='stylesheet' type='text/css'>

		<!-- Jquery Latest -->
		<script src="{THEME_PATH}/theme/scripts/jquery-latest.js" tppabs="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
		<script src="{THEME_PATH}/theme/scripts/jquery.jgrowl.js" type="text/javascript"></script>
		<link rel="stylesheet" href="{THEME_PATH}/theme/scripts/jquery.jgrowl.css"/>

		<!-- Glyphicons -->
		<link rel="stylesheet" href="{THEME_PATH}/theme/css/glyphicons.css" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/theme/css/glyphicons.css" />

		<!-- FireBug Lite -->
		<!-- <script type="text/javascript" src="https://getfirebug.com/firebug-lite-debug.js"></script> -->

		<!-- Google Analytics -->
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-36057737-1']);
			_gaq.push(['_trackPageview']);

			(function() {
				var ga = document.createElement('script');
				ga.type = 'text/javascript';
				ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www/') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(ga, s);
			})();

		</script>

	</head>
	<body class="main left-menu sticky_footer">

		<!--  Header -->

		<!-- Top Gray Line -->
		<div class="navbar navbar-fixed-top top-line">
			<div class="container-fluid">
				<!-- Logo -->
				<div class="pull-left">
					<a href="index.php" class="brand">ДУБ <strong>Книжный менеджер</strong><span class="label label-inverse">v2.0</span></a>
				</div>
				<!-- End Logo -->
				<!-- Top Right Menu -->
				<div class="pull-right">
					<span class="welcome"> Добро пожаловать, {USER_NAME}, у вас <a href="tiketList.php" class="account-type">{TIKET_COUNT} тикетов</a> <a href="tiketList.php" class="push_button orange-on-dark"><icon class="icon-pencil icon-brown"></icon>Читать</a> <span class="divider-topline"></span> </span>
					<div class="toplinks">
						<a href="login.php?action=logout">Выход <icon class="icon-share-alt icon-gray"></icon></a>
					</div>
				</div>
				<!-- End Top Right Menu -->
			</div>
		</div>
		<!-- End Top Gray Line -->

		<!-- End Header -->

		<!-- Start Content -->
		<div class="contentWrapper">
			<div class="container-fluid mainContainerFluid">

				<div class="row-fluid mainMenuWrapper">
					<div class="span2 mainMenu">

						<ul>
							<li>
								<a href="index.php">Домой</a>
							</li>
							<li>
								<a href="fileManager.php">Менеджер файлов</a>
							</li>
							<li class="dropdown open active">
								<a href="#menu_sitepages" data-toggle="collapse">Добавить <b class="caret"></b></a>
								<!-- Dropdown Menu -->
								<ul class="collapse" id="menu_sitepages">
									<li>
										<a href="bookAdd.php">Книгу</a>
									</li>
									<li class="divider"></li>
									<li class="nav-header">
										Дополнительно
									</li>
									<li>
										<a href="authorAdd.php">Автора</a>
									</li>
									<li>
										<a href="printAdd.php">Издательство</a>
									</li>
								</ul>
								<!-- End Dropdown Menu  -->
							</li>
							<li class="dropdown">
								<a href="#menu_ecommerce" data-toggle="collapse">Редактировать <b class="caret"></b></a>
								<!-- Dropdown Menu -->
								<ul class="collapse" id="menu_ecommerce">
									<li>
										<a href="bookEdit.php">Книгу</a>
									</li>
									<li class="divider"></li>
									<li class="nav-header">
										Дополнительно
									</li>
									<li>
										<a href="authorEdit.php">Автора</a>
									</li>
									<li>
										<a href="printEdit.php">Издательство</a>
									</li>
								</ul>
								<!-- End Dropdown Menu  -->
							</li>
							<li>
								<a href="tiketList.php">Тикеты</a>
							</li>
						</ul>
					</div>
					<div class="span10 mainContent">
						<div class="inner">
							<br>
							{MAIN_CONTENT}
						</div>
					</div>
				</div>

			</div>
		</div>
		<!-- End Content  -->

		<!-- Footer -->
		<div class="footer">
			<!--  Links Top Footer -->
			<div class="links">
				<div class="container">
					<div class="row">
						<div class="span2">
							<icon class="footer-icon"></icon>
						</div>
						<div class="span5">
							<ul class="footer-links">
								<li>
									Помощь
									<ul>
										<li>
											<a href="help.php">Документация</a>
										</li>
										<li>
											<a href="tiket.php">Отправить тикет</a>
										</li>
										<li>
											<a href="http://mysite.com/source">Исходники</a>
										</li>

									</ul>
								</li>
								<li>
									Дополнительно
									<ul>
										<li>
											<a href="login.php?action=logout">Выход</a>
										</li>
										<li>
											<a href="http://mosaicpro.biz/">Автор оформления - mosaicpro</a>
										</li>
									</ul>
								</li>
								<li>
									Время выполнения
									<ul>
										<li>
											{TIME_EXECUTE} сек
										</li>

									</ul>
								</li>
							</ul>
						</div>

						<div class="span5 pull-right">
							<div class="well well-small well-footer-support">
								<p>
									Если у вас возникли проблемы при использовании Live Book Manger v.1.0b system
								</p>
								<a class="btn btn-small" href="tiket.php"><icon class="icon-wrench icon-brown"></icon> Свяжитесь с поддержкой</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--  End Links Top Footer -->

			<!--  Copyright Line -->
			<div class="copy">
				&copy; 2013 - 2014. Олег Гуняков. Все права защищены
			</div>
			<!--  End Copyright Line -->

		</div>
		<!--  End Footer -->

		<!-- Sticky Footer -->
		<div id="sticky_footer">
			<ul>
				<li class="active">
					<a href="index.php-lang=en&page=site-pages-add.htm" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/index.php?page=change&toChange=menuPosition&toChangeValue=left&backto=bGFuZz1lbiZwYWdlPXNpdGUtcGFnZXMtYWRk" data-toggle="menu-position" data-menu-position="left" class="glyphicons circle_arrow_left text" title=""><i></i><span class="hidden-phone">Left menu</span></a>
				</li>
				<li>
					<a href="index.php-lang=en&page=site-pages-add.htm" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/index.php?page=change&toChange=menuPosition&toChangeValue=right&backto=bGFuZz1lbiZwYWdlPXNpdGUtcGFnZXMtYWRk" data-toggle="menu-position" data-menu-position="right" class="glyphicons circle_arrow_right text" title=""><i></i> <span class="hidden-phone">Right menu</span></a>
				</li>
				<li>
					<a href="index.php-lang=en&page=site-pages-add.htm" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/index.php?page=change&toChange=menuPosition&toChangeValue=top&backto=bGFuZz1lbiZwYWdlPXNpdGUtcGFnZXMtYWRk" data-toggle="menu-position" data-menu-position="top" class="glyphicons circle_arrow_top text" title=""><i></i> <span class="hidden-phone">Top menu</span></a>
				</li>
				<li class="divider"></li>
				<li>
					<a href="index.php-lang=en&page=documentation.htm" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/index.php?lang=en&page=documentation" class="glyphicons circle_question_mark text" title=""><i></i> <span class="hidden-phone">Documentation</span></a>
				</li>
			</ul>
		</div>
		<!-- End Sticky Footer -->

		<!-- Bootstrap JS -->
		<script src="{THEME_PATH}/bootstrap/js/bootstrap.min.js" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

		<!-- Resize Script -->
		<script src="{THEME_PATH}/theme/scripts/jquery.ba-resize.js" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/theme/scripts/jquery.ba-resize.js"></script>

		<!-- Cookies -->
		<script src="{THEME_PATH}/theme/scripts/jquery.cookie.js" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/theme/scripts/jquery.cookie.js"></script>

		<!-- Bootstrap Extended -->
		<!-- jasny plugins -->
		<script src="{THEME_PATH}/bootstrap/extend/jasny-bootstrap/js/jasny-bootstrap.min.js" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/bootstrap/extend/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript"></script>
		<!--<script src="{THEME_PATH}/bootstrap/extend/jasny-bootstrap/js/bootstrap-fileupload.js" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/bootstrap/extend/jasny-bootstrap/js/bootstrap-fileupload.js" type="text/javascript"></script>
		<!-- bootbox -->
		<script src="{THEME_PATH}/bootstrap/extend/bootbox.js" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/bootstrap/extend/bootbox.js" type="text/javascript"></script>
		<!-- wysihtml5 -->
		<script src="{THEME_PATH}/bootstrap/extend/bootstrap-wysihtml5/js/wysihtml5-0.3.0_rc2.min.js" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/bootstrap/extend/bootstrap-wysihtml5/js/wysihtml5-0.3.0_rc2.min.js" type="text/javascript"></script>
		<script src="{THEME_PATH}/bootstrap/extend/bootstrap-wysihtml5/js/bootstrap-wysihtml5-0.0.2.min.js" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/bootstrap/extend/bootstrap-wysihtml5/js/bootstrap-wysihtml5-0.0.2.min.js" type="text/javascript"></script>

		<!-- General script -->
		<script src="{THEME_PATH}/theme/scripts/load.js" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/theme/scripts/load.js?1389196426"></script>
		<script src="{THEME_PATH}/theme/scripts/custom.js" type="text/javascript"></script>
		
	</body>
</html>