<div class=container_12>

    <div class="grid_12">
        <h1>История</h1>
        {TIKET_HISTORY}
    </div>
    <div class=grid_6>

        <div class=block-border>
            <div class=block-header>
                <h1>Ответ</h1><span></span>
            </div>
            <form class="block-content form" action="tiket.php?id={ID}" method="post">
                <input type="hidden" value="answerTiket" name='action'>
                <input type="hidden" name="subject" value="Re: {subject}">
                <div class=_100>
                    <p>
                    <textarea name="message" rows="10"></textarea>
                    </p>
                </div>

                <div class=clear></div>
                <div class=block-actions>
                    <ul class=actions-left>
                        <li>
                            <a class="button red" id=reset-validate-form href="javascript:void(0);">Сброс</a>
                        </li>
                    </ul>
                    <ul class=actions-right>
                        <li>
                            <input type=submit class=button value="Отправить на сервер">
                        </li>
                    </ul>
                </div>
            </form>
        </div>
    </div>
</div>