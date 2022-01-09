<?php
/***************************************************************************************************
 * Класс: манипуляция сессиями пользователей
 ***************************************************************************************************
 * Version 		  : 2.0 stable
 * Released		  : 11-feb-2010
 * Last Modified  : 28-feb-2012
 * Author		  : O.G <oleg_gunyakov@mail.ru>
 ***************************************************************************************************
 * Лицензия GPL v2
 ***************************************************************************************************
 * Пример работы скрипта http://t-library.org.ua
 ***************************************************************************************************
 * Для любых пожеланий или баг отчетах пишите мне : oleg_goodzon@mail.ru
 ***************************************************************************************************/

class UserSession {
	private $php_session_id;
	private $native_php_session_id;
	private $user_id;
	private $name;
	private $amount;
	private $premium;
	private $freePremium;
	private $passw;
	private $emailConfirm;
	//Время в секундах между двумя страницами, после которого сессия автоматически закрывается
	private $session_time_out = 2500;
	//Время в секундах от входа пользователя на сайт до момента замены идентификатора сессии.
	private $session_life_span = 3600;
	private $logged_in = false;
	private $objDB;
	private $error;
	private $regError;
	//Название кукисов, в котором хранится идентификатор сесии.
	private $sessionName = "TADMIN_SESSION_ID";
	//private $objLog;

	public function __construct() {
		//$this -> objLog = new Log($objDB);

		$this -> objDB = $GLOBALS['objDB'];
		//Читаем значение кукисов
		$this -> native_php_session_id = @$_COOKIE[$this -> sessionName];
		//Если кукисы не пусты
		if (!empty($this -> native_php_session_id)) {
			//Проверяем наличие сессии в базе
			$data = $this -> objDB -> select("SELECT * FROM userSession WHERE hash LIKE '" . $this -> native_php_session_id . "';");
			//Если сессия существует
			if ($data) {
				//Выбираем данные сессии
				$data = $data[0];
				//-------------------------------------------------------------------------------------
				//Проверяем совпадение юзер агентов
				if (@md5($_SERVER['HTTP_USER_AGENT']) != md5($data['userAgent'])) {
					//Если юзер агенты не совпадают, удаляем сессию из базы
					$this -> objDB -> delete("userSession", array("ID" => $data["ID"]));
					//Прерываем выполнение всего приложения
					exit();
				}
				//-------------------------------------------------------------------------------------
				//Устанавливаем идентефикатор сесии
				$this -> php_session_id = $data['ID'];
				//Устанавливаем идентефикатор пользователя
				$this -> user_id = $data['userID'];
				//-------------------------------------------------------------------------------------
				//Получаем текущее время
				$time = time();
				//Получаем время последней страницы данного пользователя
				$db_time = $this -> getDBTime($data['lastPage']);
				//Если время между двумя страницами больше чем в настройках
				if ($time - $db_time > $this -> session_time_out) {
					//Сбрасываем сессию
					$this -> logged_in = false;
					//Стираем кукисы
					setcookie($this -> sessionName, "");
					//Удаляем сессию из базы
					$this -> objDB -> delete("userSession", array("ID" => $data['ID']));
				}
				//-------------------------------------------------------------------------------------
				//Если время между двумя страницами меньше чем в настройках
				else {
					//Получаем время создания сессии
					$db_time = $this -> getDBTime($data['created']);
					//Если с момента создания прошло времени больше, чем в настройках
					if ($time - $db_time > $this -> session_life_span) {
						//Генерируем новый идентификатор
						$this -> GenerateNewSessionId();
						//Обновляем данные сессии в базе
						$this -> objDB -> update('userSession', array('hash' => $this -> native_php_session_id, 'created' => $this -> getTime()), array('ID' => $this -> php_session_id));
						//Отправляем новый идентификатор через кукисы пользователю
						setcookie($this -> sessionName, $this -> native_php_session_id, 0, "/", "", 0);
					}
					//Обновляем время последней страницы в базе
					$this -> objDB -> update('userSession', array('lastPage' => $this -> getTime()), array('ID' => $this -> php_session_id));
					//-------------------------------------------------------------------------------------
					//Получаем некоторые данные о пользователе из базы
					$data = $this -> objDB -> select("SELECT *, UNIX_TIMESTAMP(datePremium) as date FROM user WHERE ID=" . $this -> user_id . ";");
					$data = $data[0];
					//Если пользователь забанен
					if ($data['ban'] != 'no') {//&& $data['emailConfirm'] == 'y'){
						//Сбрасываем сессию
						$this -> logged_in = false;
						//Стираем кукисы
						setcookie($this -> sessionName, "");
						//Удаляем сессию из базы
						$this -> objDB -> delete("userSession", array("ID" => $data['ID']));
						exit();
					}
					$this -> logged_in = true;
					$this -> user_id = $data['ID'];
					$this -> name = $data['name'];
					$this -> amount = $data['amount'];
					$this -> freePremium = $data['freePremium'];
					$this -> emailConfirm = $data['emailConfirm'];
					$this -> passw = $data['passw'];
				}
			}
		}

	}

	public function getLogin() {
		return $this -> logged_in;
	}

	public function Login($nick, $pass) {
		if ($this -> logged_in == false) {
			$data = $this -> objDB -> select("SELECT * FROM user WHERE (name LIKE '" . $nick . "' OR email LIKE '" . $nick . "') AND passw LIKE '" . md5($pass) . "';");
			if ($data) {
				$data = $data[0];
				if (@$data['ban'] == 'no') {
					$this -> logged_in = true;
					$this -> GenerateNewSessionId();
					setcookie($this -> sessionName, $this -> native_php_session_id, 0, "/", "", 0);
					$this -> user_id = $data['ID'];
					$this -> amount = $data['amount'];
					$this -> objDB -> update("user", array("lastLogin" => "NOW()"), array("ID" => $this -> user_id));
					$this -> objDB -> delete("userSession", array('userID' => $this -> user_id));
					if (!$this -> objDB -> insert("userSession", array('hash' => $this -> native_php_session_id, 'userID' => $this -> user_id, 'lastPage' => 'NOW()', 'created' => 'NOW()', 'userAgent' => @$_SERVER['HTTP_USER_AGENT']))) {
						echo($this -> objDB -> getError());
					}
					return true;
				} else {
					return false;
				}

			} else {
				return false;
			}
		}
	}

	public function Logout() {
		if ($this -> logged_in) {
			$this -> objDB -> delete('userSession', array('ID' => $this -> php_session_id));
			setcookie($this -> sessionName, '');
			$this -> logged_in = false;
		}
	}

	private function getTime() {
		$now_date = @getdate();
		$dateall = $now_date['year'] . "-" . $now_date['mon'] . "-" . $now_date['mday'] . " " . $now_date['hours'] . "-" . $now_date['minutes'] . "-" . $now_date['seconds'];
		return $dateall;
	}

	//?????????? ????? ????????????? ??????
	private function GenerateNewSessionId() {
		$this -> native_php_session_id = md5(time());
	}

	//??????? ????? ? ????????, ???????? ?? ???? ??????
	private function getDBTime($date) {
		$date = explode(" ", $date);
		$time = explode(":", $date[1]);
		$date = explode("-", $date[0]);
		$full_time = mktime($time[0], $time[1], $time[2], $date[1], $date[2], $date[0]);
		return $full_time;
	}

	//?????????? ???????? ????????? ?????????? ?? ????
	public function getUserID() {
		if ($this -> logged_in) {
			return $this -> user_id;
		} else {
			return false;
		}
	}

	public function getUserName() {
		if ($this -> logged_in) {
			return $this -> name;
		} else {
			return false;
		}
	}

	public function getUserPassw() {
		if ($this -> logged_in) {
			return $this -> passw;
		} else {
			return false;
		}
	}

	public function getUserAmount() {
		if ($this -> logged_in) {
			return $this -> amount;
		} else {
			return 0;
		}
	}

	public function getUserPath() {
		if ($this -> logged_in) {
			return md5($this -> getUserName());
		} else {
			return false;
		}
	}

	public function getUserPremium() {
		if ($this -> logged_in) {
			$data = $this -> objDB -> select("SELECT UNIX_TIMESTAMP(datePremium) as unixTime FROM user WHERE ID=" . $this -> getUserID() . ";");
			if ($data) {
				if ($data[0]['unixTime'] > time()) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function getUserDatePremium() {
		if ($this -> logged_in) {
			$data = $this -> objDB -> select("SELECT UNIX_TIMESTAMP(datePremium) as stamp FROM user WHERE ID=" . $this -> user_id . ";");
			if ($data) {
				if ($data[0]['stamp'] > time()) {
					return floor((($data[0]['stamp'] - time()) / 86400));
				} else {
					return '0';
				}
			} else {
				return '0';
			}
		} else {
			return '0';
		}
	}

	public function getUserState() {
		if ($this -> logged_in) {
			$data = $this -> objDB -> select("SELECT state FROM user WHERE ID=" . $this -> user_id . ";");
			return $data[0]['state'];
		} else {
			return false;
		}
	}

	public function getFreePremium() {
		if ($this -> logged_in) {
			return $this -> freePremium;
		} else {
			return 0;
		}
	}

	public function getEmailConfirm() {
		if ($this -> logged_in) {
			return $this -> emailConfirm;
		} else {
			return 'n';
		}
	}

	public function getSessionAscii() {
		return $this -> native_php_session_id;
	}

	public function getVarValue($var) {
		$data = $this -> objDB -> select("SELECT * FROM sessionVars WHERE sessionID=" . $this -> php_session_id . " AND name='" . $var . "';");
		$data = $data[0];
		if ($data['value']) {
			return $data['value'];
		} else {
			return "";
		}
	}

	public function setVarValue($var, $value) {
		$data = $this -> objDB -> select("SELECT * FROM sessionVars WHERE sessionID='" . $this -> php_session_id . "' AND name='" . $var . "';");
		$data = $data[0];
		if ($data['value']) {
			$this -> objDB -> update("sessionVars", array("value" => $value), array("sessionID" => $this -> php_session_id, "name" => $var));
		} else {
			$this -> objDB -> insert("sessionVars", array("value" => $value, "name" => $var, "sessionID" => $this -> php_session_id));
		}
	}

	public function regUser($name, $pass1, $pass2, $email, $placeID) {

		$this -> regError = "";

		if (empty($name)) {
			$this -> regError = $this -> regError . "<li>No login.";
		}

		//if(!preg_match("/[0-9a-z_]/i", $name)) {
		//$this -> regError = $this -> regError . "<li>Используйте только латиницу для логина.";
		//}

		if (empty($pass1)) {
			$this -> regError = $this -> regError . "<li>No pass.";
		} else {
			if ($pass1 != $pass2) {
				$this -> regError = $this -> regError . "<li>No good pass.";
			}
		}

		if (!empty($email)) {
			if (!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $email)) {
				$this -> regError = $this -> regError . "<li>No format email.";
			}
		} else {
			$this -> regError = $this -> regError . "<li>No email.";
		}

		$name = htmlspecialchars(stripslashes($name));
		$email = htmlspecialchars(stripslashes($email));

		if (empty($this -> regError)) {
			$data = $this -> objDB -> select("SELECT * FROM user WHERE name='" . $name . "' OR email='" . $email . "';");
			if (!empty($data)) {
				$this -> regError = $this -> regError . "<li>Login no free.";
			}
		}

		if (empty($this -> regError)) {
			$regData = array();
			$regData = $placeID;
			$regData['name'] = $name;
			$regData['ip'] = $_SERVER["REMOTE_ADDR"];
			$regData['passw'] = md5($pass1);
			$regData['email'] = $email;
			$regData["dateReg"] = "NOW()";
			$regData['rssID'] = md5($name . time());

			if ($this -> objDB -> insert("user", $regData)) {
				$data = $this -> objDB -> select("SELECT * FROM user WHERE name='" . $name . "';");

				$hash = md5(time());
				$message = "<p>Вы только что зарегестрировались на сайте South CITY - обьедененный бизнес-справочник. <p>Подтвердите свой email нажав на эту ссылку. <a href='http://www.south-city.com.ua/confirm.php?hash_str=" . $hash . "'>http://www.south-city.com.ua/confirm.php?hash_str=" . $hash . "</a> <p>Или ваш аккаунт будет удален в течении 3(х) дней.";
				$this -> objDB -> insert("confirmEmail", array("hash" => $hash, "userID" => $data[0]['ID'], "datePut" => "NOW()"));

				require_once "../class/class.EMail.php";
				$objEmail = new Email($this -> objDB);

				$objEmail -> add_html(Array("EMAIL_TITLE" => "Подтверждение регистрации.", "EMAIL_CONTENT" => $message));
				$objEmail -> send(0, $email, "Подтверждение email для South CITY");
				return "yes";
			} else {
				$this -> regError = $this -> regError . $this -> objDB -> getError();
			}

		}

		return $this -> regError;
	}

}
?>
