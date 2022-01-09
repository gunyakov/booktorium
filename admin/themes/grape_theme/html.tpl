<!doctype html>

<!--
This is a minified version of the ThemeForest-Theme "Grape - Professional & Flexible Admin Template".
Author: Simon Stamm (Stammi)

Note: If you buy my theme on ThemeForest, you will receive the non-minified and commented/documentated version!
This is a minified version of my theme to prevent stealing.
-->

<!--[if lt IE 7]><html class="no-js ie6 oldie" lang=en><![endif]-->
<!--[if IE 7]><html class="no-js ie7 oldie" lang=en><![endif]-->
<!--[if IE 8]><html class="no-js ie8 oldie" lang=en><![endif]-->
<!--[if gt IE 8]><!-->
<html class=no-js lang=en>
	<!--<![endif]-->
	<!-- Mirrored from themes.stammtec.de/grape/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2010], Mon, 15 Aug 2011 04:39:15 GMT -->
	<head>
		<meta charset=utf-8>
		<link rel=dns-prefetch href="http://fonts.googleapis.com/">
		<meta http-equiv=X-UA-Compatible content="IE=edge,chrome=1">
		<title>Администрирование :: Дуб 1.4b</title>
		<link href="favicon.ico" rel="shortcut icon"/>
		<meta name=description content="">
		<meta name=author content="">
		<meta name=viewport content="width=device-width,initial-scale=1">
		<link rel=stylesheet href='{THEME_PATH}/css/style.css'>
		<link rel=stylesheet href="{THEME_PATH}/css/jQueryUI/jquery-ui.min.css">
		<link href="http://fonts.googleapis.com/css?family=PT+Sans" rel=stylesheet type="text/css">
		<script src="{THEME_PATH}/js/libs/modernizr-2.0.6.min.js"></script>
		<script src="{THEME_PATH}/js/jquery.min.js"></script>
        <script>
            window.jQuery || document.write('<script src="{THEME_PATH}/js/libs/jquery-1.8.2.min.js"><\/script>');
        </script>
		
		
	</head>
	<body id=top>
		<div id="container">
			<div id="header-surround">
				<header id="header">
					<img src="{THEME_PATH}/img/logo.png" alt=Grape class=logo><div class="divider-header divider-vertical"></div>
					<div id="user-info">
						<p>
							<span class=messages>Добро пожаловать <a href="userList.php?id={ADMIN_ID}">{ADMIN_NAME}</a> ( <a href="tiket.php"><img src="{THEME_PATH}/img/icons/packs/fugue/16x16/mail.png" alt=Messages> {TIKET_COUNT} новых тикета(ов)</a> )</span><a href="login.php?action=logout" class="button red">Выход</a>
						</p>
					</div>
				</header>
			</div>
			<div class="fix-shadow-bottom-height"></div>
			<aside id="sidebar">
				<div id="search-bar">
					<form id="search-form" name="search-form" action="#" method="post">
						<input type="text" id="query" name="query" value="" autocomplete="off" placeholder="Время выполнения: {TIME_EXECUTE} сек">
					</form>
				</div>
				<section id=login-details>
					<img class="img-left framed" src="{THEME_PATH}/img/misc/avatar_small.png" alt="Hello Admin"><h3>Вы вошли как </h3><h2><a class=user-button href="javascript:void(0);">{ADMIN_NAME}&nbsp;<span class="arrow-link-down"></span></a></h2>
					<ul class=dropdown-username-menu>
						<li>
							<a href="userList.php?id={ADMIN_ID}">Профиль</a>
						</li>
						<li>
							<a href="userOption.php?id={ADMIN_ID}">Настройки</a>
						</li>
						<li>
							<a href="login.php?action=logout">Выход</a>
						</li>
					</ul>
					<div class=clearfix></div>
				</section>
				<nav id=nav>
					<ul class="menu collapsible shadow-bottom">
						<li>
							<a href="userList.php"><img src="{THEME_PATH}/img/icons/packs/fugue/16x16/user-white.png">Пользователи <span class="badge red">{USER_COUNT}</span></a>
						</li>
						<li>
							<a href="javascript:void(0);"><img src="{THEME_PATH}/img/icons/packs/fugue/16x16/address-book.png">Книги <span class="badge grey">{BOOK_COUNT}</span></a>
						    <ul class=sub>
                                <li>
                                    <a href="bookList.php">Показать новые</a>
                                </li>
                                <li>
                                    <a href="bookList.php?show=all">Показать все</a>
                                </li>
                            </ul>
						</li>
						<li>
							<a href="javascript:void(0);"><img src="{THEME_PATH}/img/icons/packs/fugue/16x16/ui-tab-content.png">Категории</a>
							<ul class=sub>
								<li>
									<a href="addCategory.php">Добавить</a>
								</li>
								<li>
									<a href="categoryList.php">Редактировать</a>
								</li>
							</ul>
						</li>
						<li>
                            <a href="comments.php"><img src="{THEME_PATH}/img/icons/packs/fugue/16x16/notebook.png">Коментарии <span class="badge red">{COMMENT_COUNT}</span></a>
                        </li>
						<li>
                            <a href="tiket.php"><img src="{THEME_PATH}/img/icons/packs/fugue/16x16/balloon.png">Тикеты <span class="badge grey">{TIKET_COUNT}</span></a>
                        </li>
						<li>
                            <a href="options.php"><img src="{THEME_PATH}/img/icons/packs/fugue/16x16/gear.png">Настройки по умолчанию</a>
                        </li>
						<li>
                            <a href="fixProblem.php"><img src="{THEME_PATH}/img/icons/packs/fugue/16x16/application--exclamation.png">Устранить проблемы</a>
                        </li>
                        <li>
                            <a href="resetCounters.php"><img src="{THEME_PATH}/img/icons/packs/fugue/16x16/alarm-clock.png">Сбросить счетчики</a>
                        </li>
					</ul>
				</nav>
			</aside>
			<div id="main" role="main">
				<div id="title-bar">
					<ul id="breadcrumbs">
						<li class="no-hover">
							Администрирование :: Дуб 1.4b
						</li>
					</ul>
				</div>
				<div class="shadow-bottom shadow-titlebar"></div>
				<div id="main-content">
					{MAIN_CONTENT}
					<div class="clear height-fix"></div>
				</div>
			</div>
			<footer id="footer">
				<div class=container_12>
					<div class=grid_12>
						<div class="footer-icon align-center">
							<a class=top href="#top"></a>
						</div>
					</div>
				</div>
			</footer>
		</div>
		
		<script defer src='{THEME_PATH}/js/function.js'></script>
        <script src="{THEME_PATH}/js/custom.js"></script>
		<!--[if lt IE 7 ]><script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script> <script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})});</script><![endif]-->
	</body>
	<!-- Mirrored from themes.stammtec.de/grape/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2010], Mon, 15 Aug 2011 04:40:03 GMT -->
</html>