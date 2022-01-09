<?php
/**************************************************************************************************
 * Класс: отсылка почты пользователю. Часть проекта "Южный город"
 ***************************************************************************************************
 * Version 		: 1.0alpha
 * Released		: 11-feb-2012
 * Last Modified : 31-mar-2012
 * Author		: O.G <oleg_gunyakov@mail.ru>
 *
 ***************************************************************************************************
 * Лицензия
 ***************************************************************************************************
 * Все права защищены законом Украины и России об авторских правах.
 * Организациям/лицам которые на базе данного скрипта будут предоставлять
 * в небольших городах/селах/поселках услуги на некомерческой основе
 * лицензия выдается бесплатно
 *
 ***************************************************************************************************
 * Пример работы скрипта http://south-city.com.ua
 ***************************************************************************************************
 * Для любых пожеланий или баг отчетах пишите мне : oleg_goodzon@mail.ru
 ***************************************************************************************************/

class EMail {
	private $html;
	private $parts = array();
	private $from = 'no_reply@t-library.net';
	private $serverAdress = 'https://t-library.net/email/images/';
	private $objLog;

	public function __construct() {
	}

	public function add_html($arrContent) {
		$file = file_get_contents("/home/admin/web/t-library.net/public_html/email/email.html");
		foreach ($arrContent as $key => $val) {
			$file = str_replace("{" . $key . "}", $val, $file);
		}
		$file = str_replace("images/", $this -> serverAdress, $file);
		$this -> html = $file;
	}

	public function send($userID, $email = '', $subject = "", $headers = "") {
		$objDB = $GLOBALS['objDB'];
		$data = $objDB -> select("SELECT email FROM user WHERE ID=" . $userID . ";");
		if ($data) {
			$data = $data[0];
		} else {
			$data['email'] = $email;
		}
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= 'To: <' . $data['email'] . '>' . "\r\n";
		$headers .= 'From: Открытая техническая библиотека <help@t-library.org.ua>' . "\r\n";
		$headers .= "X-Mailer: TLibraryOrgUAMailAgent!\r\n";
		return mail($data['email'], $subject, $this -> html, $headers);

	}

}
?>
