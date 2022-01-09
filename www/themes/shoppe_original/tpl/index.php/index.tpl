<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Открытая техническая библиотека :: ДУБ 2.0a</title>
		<!--[if lt IE 9]>
		<script src="../../html5shim.googlecode.com/svn/trunk/html5.js" tppabs="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<!--[if lt IE 9]>
		<script src="../../css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js" tppabs="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
		<![endif]-->
		<meta http-equiv="cache-control" content="no-cache">
		<meta name="keywords" content="техническая библиотека, бесплатная библиотека, бесплатная техническая библиотека, технические книги скачать, технические книги скачать бесплатно">
		<meta name="description" content="Открытая бесплатная техническая библиотека. Бесплатно скачать книги. Чтение книг онлайн в формате pdf и djvu">
		<meta name="google-site-verification" content="OJz147UFDUjfFJBBEJ6w-7At_xpyDvSQY_NWwQD1UYU" />
		<meta name='yandex-verification' content='6b9dc37c7fcb1909' />
		<meta name="alexaVerifyID" content="hIXiP6Tmi6hUs4vqLCqjLcQ6un4" />
		<meta name="wot-verification" content="c9f3794563e2f68eb0f8"/>
		<meta name="cypr-verification" content="f39889823bec16db852fbe18ef0d6003"/>
		<meta name='wmail-verification' content='65779d503e1ce2f1' />
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		<meta name="viewport" content="width=device-width">
		<!-- Css Files Start -->
		<link href="{THEME_PATH}/css/style.css" tppabs="http://html.crunchpress.com/book-store/css/style.css" rel="stylesheet" type="text/css" />
		<!-- All css -->
		<link href="{THEME_PATH}/css/bs.css" tppabs="http://html.crunchpress.com/book-store/css/bs.css" rel="stylesheet" type="text/css" />
		<!-- Bootstrap Css -->
		<link rel="stylesheet" type="text/css" href="{THEME_PATH}/css/main-slider.css" tppabs="http://html.crunchpress.com/book-store/css/main-slider.css" />
		<!-- Main Slider Css -->
		<!--[if lte IE 10]><link rel="stylesheet" type="text/css" href="{THEME_PATH}/css/customIE.css" tppabs="http://html.crunchpress.com/book-store/css/customIE.css" /><![endif]-->
		<link href="{THEME_PATH}/css/font-awesome.css" tppabs="http://html.crunchpress.com/book-store/css/font-awesome.css" rel="stylesheet" type="text/css" />
		<!-- Font Awesome Css -->
		<link href="{THEME_PATH}/css/font-awesome-ie7.css" tppabs="http://html.crunchpress.com/book-store/css/font-awesome-ie7.css" rel="stylesheet" type="text/css" />
		<!-- Font Awesome iE7 Css -->
		<noscript>
			<link rel="stylesheet" type="text/css" href="{THEME_PATH}/css/noJS.css" tppabs="http://html.crunchpress.com/book-store/css/noJS.css" />
		</noscript>
		<!-- Css Files End -->
	</head>
	<body>
		<!-- Start Main Wrapper -->
		<div class="wrapper">
			<!-- Start Main Header -->
			<!-- Start Top Nav Bar -->
			<section class="top-nav-bar">
				<section class="container-fluid container">
					<section class="row-fluid">
						<section class="span6">
							<ul class="top-nav">
								<li>
									<a href="index.php" class="active">Домой</a>
								</li>
								<li>
									<a href="priceTable.php">Таблица разрешений</a>
								</li>
								<li>
									<a href="http://lbm.t-library.org.ua">Книжный менеджер</a>
								</li>
								<li>
									<a href="http://vk.com/techlibrary">Мы Вконтакте</a>
								</li>
							</ul>
						</section>
						<section class="span6 e-commerce-list">
							<ul>
								{TOP_MENU_CONTENT}
							</ul>
							<div class="c-btn">
								<a href="http://t-library.org.ua" class="cart-btn">ДУБ</a>
								<div class="btn-group">
									<button data-toggle="dropdown" class="btn btn-mini dropdown-toggle">
										исходники<span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li>
											<a href="http://www.dub-project.ru/download.php">Исходники движка</a>
										</li>
										<li>
											<a href="http://www.dub-project.ru/theme.php?page=ui">Исходники темы</a>
										</li>
										<li>
											<a href="http://www.dub-project.ru">Сайт проекта</a>
										</li>
									</ul>
								</div>
							</div>
						</section>
					</section>
				</section>
			</section>
			<!-- End Top Nav Bar -->
			<header id="main-header">
				<section class="container-fluid container">
					<section class="row-fluid">
						<section class="span4">
							<h1 id="logo"><a href="index.php"><img src="{THEME_PATH}/images/logo.png"></a></h1>
						</section>
						<section class="span4">
						Всего книг: {BOOKS_COUNT}<br>
						Всего авторов: {AUTHOR_COUNT}<br>
						Всего издательств: {PRINT_COUNT}<br>
						Общий обьем файлов книг: {FILE_SIZE}
						</section>
						<section class="span4">
							<ul class="top-nav2">
								<li>
									<a href="https://vps.ua/clients/aff.php?aff=636">Сайт работает на VPS, предоставленный VPS.ua</a>
								</li>

							</ul>
							<div class="search-bar">
								<form action="search.php" method="get">
									<input name="" type="text" name="s" value="Я ищу..." />
									<input name="" type="submit" value="Отправить" />
								</form>
							</div>
						</section>
					</section>
				</section>
				<!-- Start Main Nav Bar -->
				<nav id="nav">
					<div class="navbar navbar-inverse">
						<div class="navbar-inner">
							<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
								<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
							</button>
							<div class="nav-collapse collapse">
								<ul class="nav">
									{MAIN_MENU_CONTENT}
								</ul>
							</div>
							<!--/.nav-collapse -->
						</div>
						<!-- /.navbar-inner -->
					</div>
					<!-- /.navbar -->
				</nav>
				<!-- End Main Nav Bar -->
			</header>
			<!-- End Main Header -->
			<!-- Start Main Content Holder -->
			<section id="content-holder" class="container-fluid container">
				<section class="row-fluid">
					<section class="span12 slider">
						<section class="main-slider">
							<div class="bb-custom-wrapper">
								<div id="bb-bookblock" class="bb-bookblock">
									{NEW_BOOK_CONTENT}
								</div>
							</div>
							<nav class="bb-custom-nav">
								<a href="#" id="bb-nav-prev" class="left-arrow">Previous</a><a href="#" id="bb-nav-next" class="right-arrow">Next</a>
							</nav>
						</section>
						<span class="slider-bottom"><img src="{THEME_PATH}/images/slider-bg.png" alt="Shadow"/></span>
					</section>
					<section class="span12 wellcome-msg m-bottom first">
						<h2>Добро пожаловать в онлайн библиотеку <B>t-library.net</B>!</h2>
						<p>
							Лучшие технические книги в свободном доступе.
						</p>
					</section>
					<article class="b-post">
<p color="red"><b>В связи с постояными проблемами днс серверов регистратора org.ua, сайт был перенесен на доменн t-library.net.</b></p>
<p>Так же сайт доступен по следующим зеркалам: <a href="http://www.t-library.ru">http://www.t-library.ru</a> <a href="http://www.t-library.org">http://www.t-library.org</a> <a href="http://www.t-library.org.ua">http://www.t-library.org.ua</a>
						<P ALIGN=JUSTIFY>
							Если вам понравился движок, на котором работает этот сайт и вы хотите себе такой - пишите на почту,что указана в конце страницы.
						</p>
						<P ALIGN=JUSTIFY>
							Наверное каждый технарь хоть раз в жизни сталкивался с проблемой отсутствия нормальной современной технической литературы.
							Большинство нормальных книг по технике достались нам в наследство после развала СССР.
							Но даже сейчас эти книги пользуются популярностью, так как нам все равно нужно решать технические задачи, независимо от наличие требуемой современной литературы.
							Не всегда можно найти требуемую книгу в библиотеке. Да и времени на посещение библиотеки не всегда можно найти.
							Данная библиотека разрабатывалась как полностью открытая. Это подразумевает как свободный доступ к интересующей литературе, так и свободное размещение пользовательских книг на данном сайте.
						</p>
						<p align="justify">
							Так как проект держится лишь на моем энтузиазме, сервер, выделенный под данный проект обладает довольно скромными возможностями. Поэтому пришлось ввести некоторые ограничения, дабы избежать перегрузки сервера.
							Надеюсь со временем у меня появится возможность увеличить мощность сервера, и снять эти ограничения. Всех, кто желает разместить книги на данном проекте, тем самым поддержав его развитие, просьба посетить Library Book Manager, доступный из меню "Дополнительно".
							Для входа используйте логин и пароль при регистрации на основном сайте.
						</P>
						<p align="justify">
							Для хранения файлов я не использую файлообменные хостинги. Места на моем хард диске предостаточно, поэтому я гарантирую, что любая книга, которая будет добавлена на сайт и одобрена администрацией, будет доступна к скачиванию другим пользователям навсегда
							(если размещение книги не противоречит авторскому праву, либо до ближайшего мирового апокалипсиса =))) ). Ежедневно сервер создает бекап проекта на внешний хард диск, а это гарантирует сохранность добавленных книг.
						</P>
						<p align="justify">
							Не всегда пользователю нужно закачивать целую книгу. Иногда нужно лишь пару страниц. Не проблема. Я разработал проект так, чтоб каждый пользователь имел возможность читать любую добавленную книгу прямо с этого сайта.
							Это дает возможность предварительно ознакомиться с качеством размещенной книги, а так же не тратить лишний трафик, если необходимо всего лишь пару страниц из книги.
						</P>
						<p align="justify">
							Распознавание страниц, основанное на пакете cuneiform, позволяет на ходу распознавать наиболее важные страницы, и использовать готовый текст для своих нужд.
							Сразу уточню, что качество распознавание текста зависит в первую очередь от качества исходного файла. И свободнораспространяемый cuneiform это вам не коммерческий гигант FineReader. Не ждите от него чудес.
						</p>
						<p align="justify">
							Система закладок позволит быстро возвращаться к интересным страницам и книгам. Поиск по авторам и издательствам позволит пользователям максимально быстро находить интересующие его книги.
						</P>
					</article>
				</section>
				<!-- Start BX Slider holder -->
				<section class="row-fluid features-books">
					<section class="span12 m-bottom">
						<div class="heading-bar">
							<h2>Самые загружаемые книги</h2>
							<span class="h-line"></span>
						</div>
						<div class="slider1">
							{TOP_DOWNLOAD_CONTENT}
						</div>
					</section>
				</section>
				<!-- End BX Slider holder -->
				<!-- Start BX Slider holder -->
				<section class="row-fluid features-books">
					<section class="span12 m-bottom">
						<div class="heading-bar">
							<h2>Самые рейтинговые книги</h2>
							<span class="h-line"></span>
						</div>
						<div class="slider1">
							{TOP_RATING_CONTENT}
						</div>
					</section>
				</section>
				<!-- End BX Slider holder -->
				<!-- Start BX Slider holder -->
				<section class="row-fluid features-books">
					<section class="span12 m-bottom">
						<div class="heading-bar">
							<h2>Самые читаемые книги</h2>
							<span class="h-line"></span>
						</div>
						<div class="slider1">
							{TOP_READ_CONTENT}
						</div>
					</section>
				</section>
				<!-- End BX Slider holder -->
				<!-- Start BX Slider holder -->
				<section class="row-fluid features-books">
					<section class="span12 m-bottom">
						<div class="heading-bar">
							<h2>Самые обсуждаемые книги</h2>
							<span class="h-line"></span>
						</div>
						<div class="slider1">
							{TOP_COMMENT_CONTENT}
						</div>
					</section>
				</section>
				<!-- End BX Slider holder -->
			</section>
			<!-- End Main Content Holder -->
			<!-- Start Footer Top 1 -->
			<section class="container-fluid footer-top1">
				<section class="container">
					<section class="row-fluid">
						<figure class="span3">
							<h4>Выполнено: </h4>
							<p>
								{EXECUTE_TIME} секунд
							</p>
							<p>
								Идея и разработка - <a href="http://promodj.com/o-g">Олег Гуняков</a>
							</p>
							<p>
								<!-- I.UA counter --><a href="http://www.i.ua/" target="_blank" onclick="this.href='http://i.ua/r.php?163400';" title="Rated by I.UA">
								<script type="text/javascript" language="javascript">
									<!--
									iS='<img src="https://r.i.ua/s?u163400&p124&n' + Math.random();
									iD = document;
									if (!iD.cookie)
										iD.cookie = "b=b; path=/";
									if (iD.cookie)
										iS += '&c1';
									iS += '&d' + (screen.colorDepth ? screen.colorDepth : screen.pixelDepth) + "&w" + screen.width + '&h' + screen.height;
									iT = iD.referrer.slice(7);
									iH = window.location.href.slice(7);
									(( iI = iT.indexOf('/')) != -1) ? ( iT = iT.substring(0, iI)) : ( iI = iT.length);
									if (iT != iH.substring(0, iI))
										iS += '&f' + escape(iD.referrer.slice(7));
									iS += '&r' + escape(iH);
									iD.write(iS + '" border="0" width="88" height="31" />');
									//-->
								</script></a><!-- End of I.UA counter -->
<!--LiveInternet counter--><script type="text/javascript"><!--
document.write("<a href='//www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t52.6;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random()+
"' alt='' title='LiveInternet: показано число просмотров и"+
" посетителей за 24 часа' "+
"border='0' width='88' height='31'><\/a>")
//--></script><!--/LiveInternet-->
<!-- Yandex.Metrika informer --> <a href="https://metrika.yandex.ru/stat/?id=21444919&amp;from=informer" target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/21444919/3_0_20FF9FFF_00FF7FFF_0_pageviews" style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:21444919,lang:'ru'});return false}catch(e){}" /></a> <!-- /Yandex.Metrika informer --> <!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter21444919 = new Ya.Metrika({ id:21444919, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <!-- /Yandex.Metrika counter -->
							</p>
						</figure>
						<figure class="span6">
							<h4>Онлайн библиотека t-library.net</h4>
							<p align="justify">
								Основано на Дуб 2.0a. Все права на серверную часть принадлежат разработчику.
								Материалы размещаются на сайте либо по согласию правообладателей, либо открыто доступные в интернете.
								Если какие либо материалы нарушают ваши авторсике права - напишите нам, и мы разберемся в этом.
							</p>

						</figure>
						<figure class="span3">
							<h4>Быстрые ссылки</h4>
							<ul class="tweets-list">
								<li>
									<a href="showPrint.php">Список издательств</a>
								</li>
								<li>
									<a href="showAuthor.php">Список авторов</a>
								</li>
								<li>
									<a href="registration.php">Регистрация</a>
								</li>
								<li>
									<a href="login.php">Войти на сайт</a>
								</li>
							</ul>
						</figure>
					</section>
				</section>
			</section>
			<!-- End Footer Top 1 -->
			<!-- Start Main Footer -->
			<footer id="main-footer">
				<section class="social-ico-bar">
					<section class="container">
						<section class="row-fluid">
							<article class="span6">
								<p>
									© 2012-2018  <a href="http://promodj.com/o-g">Гуняков Олег</a>
								</p>
							</article>
							<article class="span6 copy-right">
								<p>
									Дизайн от <a href="http://html.crunchpress.com/book-store/index.html">Crunchpress.com</a>
								</p>
							</article>
						</section>
					</section>
				</section>
			</footer>
			<!-- End Main Footer -->
		</div>
		<!-- End Main Wrapper -->

		<!-- JS Files Start -->
		<script type="text/javascript" src="{THEME_PATH}/js/lib.js" tppabs="http://html.crunchpress.com/book-store/js/lib.js"></script><!-- lib Js -->
		<script type="text/javascript" src="{THEME_PATH}/js/modernizr.js" tppabs="http://html.crunchpress.com/book-store/js/modernizr.js"></script><!-- Modernizr -->
		<script type="text/javascript" src="{THEME_PATH}/js/easing.js" tppabs="http://html.crunchpress.com/book-store/js/easing.js"></script><!-- Easing js -->
		<script type="text/javascript" src="{THEME_PATH}/js/bs.js" tppabs="http://html.crunchpress.com/book-store/js/bs.js"></script><!-- Bootstrap -->
		<script type="text/javascript" src="{THEME_PATH}/js/bxslider.js" tppabs="http://html.crunchpress.com/book-store/js/bxslider.js"></script><!-- BX Slider -->
		<script type="text/javascript" src="{THEME_PATH}/js/input-clear.js" tppabs="http://html.crunchpress.com/book-store/js/input-clear.js"></script><!-- Input Clear -->
		<script src="{THEME_PATH}/js/range-slider.js" tppabs="http://html.crunchpress.com/book-store/js/range-slider.js"></script><!-- Range Slider -->
		<script src="{THEME_PATH}/js/jquery.zoom.js" tppabs="http://html.crunchpress.com/book-store/js/jquery.zoom.js"></script><!-- Zoom Effect -->
		<script type="text/javascript" src="{THEME_PATH}/js/bookblock.js" tppabs="http://html.crunchpress.com/book-store/js/bookblock.js"></script><!-- Flip Slider -->
		<script type="text/javascript" src="{THEME_PATH}/js/custom.js" tppabs="http://html.crunchpress.com/book-store/js/custom.js"></script><!-- Custom js -->
		<script type="text/javascript" src="{THEME_PATH}/js/social.js" tppabs="http://html.crunchpress.com/book-store/js/social.js"></script><!-- Social Icons -->
		<script src="{THEME_PATH}/js/voc89b0.js" charset="utf-8"></script>

<!-- JS Files End -->
		<noscript>
			<style>
				#socialicons > a span {
					top: 0px;
					left: -100%;
					-webkit-transition: all 0.3s ease;
					-moz-transition: all 0.3s ease-in-out;
					-o-transition: all 0.3s ease-in-out;
					-ms-transition: all 0.3s ease-in-out;
					transition: all 0.3s ease-in-out;
				}
				#socialicons > ahover div {
					left: 0px;
				}
			</style>
		</noscript>
		<script type="text/javascript">
			/* <![CDATA[ */
			$(document).ready(function() {
				$('.social_active').hoverdir({});
			})
			/* ]]> */
		</script>
	</body>
</html>
