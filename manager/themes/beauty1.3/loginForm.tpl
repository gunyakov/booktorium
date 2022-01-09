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
		<link href="{THEME_PATH}/theme/css/beautyadmin.css" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/theme/css/beautyadmin.css?1389196448" rel="stylesheet">

		<!--  Google Open Sans Font -->
		<link href="http://fonts.googleapis.com/css-family=Open+Sans-400,300,600,700&subset=latin,latin-ext.css" tppabs="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=latin,latin-ext" rel='stylesheet' type='text/css'>

		<!-- Jquery Latest -->
		<script src="{THEME_PATH}/theme/scripts/jquery-latest.js" tppabs="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>

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
	<body class="login right-menu sticky_footer">

		<!--  Header -->

		<!-- Top Gray Line -->
		<div class="navbar navbar-fixed-top top-line">
			<div class="container-fluid">
				<!-- Logo -->
				<div class="pull-left">
					<a href="index.php" class="brand">ДУБ <strong>Книжный менеджер</strong><span class="label label-inverse">v2.0</span></a>
				</div>
				<!-- End Logo -->
			</div>
		</div>
		<!-- End Top Gray Line -->

		<!-- End Header -->

		<!-- Start Content -->
		<div class="container-fluid mainContainerFluid">

			<form action="login.php" class="well login-form" id="form" method="post">
                <input type="hidden" name="action" value="login">
                <legend>
                    <icon class="icon-circles"></icon>
                    Ограниченная зона<icon class="icon-circles-reverse"></icon>
                </legend>
                <div class="control-group">
                    <label class="control-label" for="inputPassword">Имя пользователя</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><icon class="icon-user icon-cream"></icon></span>
                            <input class="input" type="text" name="name" placeholder="username" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputPassword">Пароль</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><icon class="icon-password icon-cream"></icon></span>
                            <input class="input" type="password" name="passw" placeholder="password" />
                        </div>
                    </div>
                </div>
                <div class="control-group signin">
                    <div class="controls ">
                        <button type="submit" class="btn btn-block" id="">
                            Войти
                        </button>
                        <div class="clearfix">
                            <span class="icon-forgot"></span><a href="#">Забыли пароль?</a>
                        </div>
                    </div>
                </div>
            </form>


		</div>
		<!-- End Content  -->

		<!-- Footer Login  -->
		<div class="footer" align="center">
			<p><img src="{THEME_PATH}/theme/img/250x100.gif" tppabs="http://placehold.it/250x100" class="img-rounded" />
			</p>
			<p>
				&copy; 2013 - 2014. Олег Гуняков. Все права защищены
			</p>
		</div>
		<!--  End Footer Login -->

		<!-- Bootstrap JS -->
		<script src="{THEME_PATH}/bootstrap/js/bootstrap.min.js" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

		<!-- Resize Script -->
		<script src="{THEME_PATH}/theme/scripts/jquery.ba-resize.js" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/theme/scripts/jquery.ba-resize.js"></script>

		<!-- Cookies -->
		<script src="{THEME_PATH}/theme/scripts/jquery.cookie.js" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/theme/scripts/jquery.cookie.js"></script>

		<!-- Bootstrap Extended -->
		<!-- jasny plugins -->
		<script src="{THEME_PATH}/bootstrap/extend/jasny-bootstrap/js/jasny-bootstrap.min.js" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/bootstrap/extend/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript"></script>
		<script src="{THEME_PATH}/bootstrap/extend/jasny-bootstrap/js/bootstrap-fileupload.js" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/bootstrap/extend/jasny-bootstrap/js/bootstrap-fileupload.js" type="text/javascript"></script>
		<!-- bootbox -->
		<script src="{THEME_PATH}/bootstrap/extend/bootbox.js" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/bootstrap/extend/bootbox.js" type="text/javascript"></script>
		<!-- wysihtml5 -->
		<script src="{THEME_PATH}/bootstrap/extend/bootstrap-wysihtml5/js/wysihtml5-0.3.0_rc2.min.js" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/bootstrap/extend/bootstrap-wysihtml5/js/wysihtml5-0.3.0_rc2.min.js" type="text/javascript"></script>
		<script src="{THEME_PATH}/bootstrap/extend/bootstrap-wysihtml5/js/bootstrap-wysihtml5-0.0.2.min.js" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/bootstrap/extend/bootstrap-wysihtml5/js/bootstrap-wysihtml5-0.0.2.min.js" type="text/javascript"></script>

		<!-- General script -->
		<script src="{THEME_PATH}/theme/scripts/load.js" tppabs="http://demo.mosaicpro.biz/beautyadmin/php/theme/scripts/load.js"></script>

	</body>
</html>