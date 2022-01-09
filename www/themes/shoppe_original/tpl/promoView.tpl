<!-- 240*400 Advertur.ru start -->
<div id="advertur_130350"></div>
<div id="130350_240_400" style="display: none;"></div>
<script type="text/javascript">
    (function(w, d, n, ln) {
        w[n] = w[n] || [];
        w[n].push({
            section_id: 130350,
            place: "advertur_130350",
            width: 240,
            height: 400,
            message: "<b>Отключите AdBlock!</b><br> <b>AdBlock</b> — блокирует рекламу. Показывая рекламу, вы тем самым поддерживаете наш сайт и стимулируете развитие."
        });

        if (!w[ln]) {
            w[ln] = {};

            var s = d.createElement("script");
            s.type = "text/javascript";
            s.charset = "utf-8";
            s.src = "//ddnk.advertur.ru/v1/s/loader.js";
            s.async = true;
            s.onerror = function () {
                if (w != w.top) {
                    return;
                }

                var counter = 0,
                    fn = function () {
                        if (counter >= 60) {
                            clearInterval(interval);
                            return;
                        }
                        counter++;
                        w[n].forEach(function (item) {
                            if (item.hasOwnProperty('rendered') && item.rendered) {
                                return;
                            }

                            var el = d.getElementById([item.section_id, item.width, item.height].join('_'));
                            if (!el) {
                                return;
                            }

                            el.style.width = item.width + "px";
                            el.style.height = item.height + "px";
                            el.innerHTML = item.message;
                            el.style.display = '';
                            item.rendered = true;
                        });
                    },
                    interval = setInterval(fn, 1000)
                ;
            };
            document.body.appendChild(s);
        }
    })(window, document, "advertur_sections", "advertur_loader");
</script>
<!-- 240*400 Advertur.ru end -->

<!-- Start Latest Reviews Section -->
<div class="side-holder">
    <article class="l-reviews">
        <h2>Новинки сайта</h2>
        <div class="side-inner-holder">
            {PROMO_CONTENT}
        </div>
    </article>
</div>
<!-- End Latest Reviews Section -->
