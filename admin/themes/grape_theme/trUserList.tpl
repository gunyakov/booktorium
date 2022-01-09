<tr>
    <td><a href="userList.php?action=delUser&id={ID}" rel="tooltip-left" title="Удалить пользователя"><img src="{THEME_PATH}/img/icons/packs/fugue/24x24/cross.png"></a>
        <a href="userList.php?id={ID}" rel="tooltip-bottom" title="Редактировать пользователя"><img src="{THEME_PATH}/img/icons/packs/fugue/24x24/information.png"></a>
        <a href="userOption.php?id={ID}" rel="tooltip-top" title="Изменить настройки пользователя"><img src="{THEME_PATH}/img/icons/packs/fugue/24x24/equalizer.png"></a>
        <a href="resetCounters.php?id={ID}&action=resetUserCounters" rel="tooltip-right" title="Сбросить счетчик пользователя"><img src="{THEME_PATH}/img/icons/packs/fugue/24x24/alarm-clock.png"></a>
    </td>
    <td>{name}</td>
    <td>{email}</td>
    <td><a href="javascript:void(0);" rel="tooltip-right" title="Е-Мейл подтвержден: {emailConfirm}"><img src="{THEME_PATH}/img/icons/packs/fugue/24x24/{emailConfirm}.png"></a></td>
    <td>{amount}</td>
    <td><a href="javascript:void(0);" rel="tooltip-right" title="{state}"><img src="{THEME_PATH}/img/icons/packs/fugue/24x24/{state}.png"></a></td>
    <td>{dateRegistration}</td>
    <td>{lastLogin}</td>
</tr>