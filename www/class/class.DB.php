<?php
/***************************************************************************************************
 * Класс: База данных
 ***************************************************************************************************
 * Описание: Отвечает за соеденение с базой, формирование запросов и конвертирование ответов от базы
 *           в массив данных. Для работы используется MySQL.
 ***************************************************************************************************
 * Version 		  : 3.1
 * Released		  : 10-jun-2006
 * Last Modified          : 04-dec-2017
 * Author		  : O.G <oleg_gunyakov@mail.ru>
 ***************************************************************************************************
 * Лицензия GPL v2
 ***************************************************************************************************
 * Пример работы скрипта http://t-library.org.ua
 ***************************************************************************************************
 * Для любых пожеланий или баг отчетах пишите мне : oleg_goodzon@mail.ru
 ***************************************************************************************************/

//--------------------------------------------------------------------------------------------------
class DB {
	private $error;
	private $dbcnx;

	//----------------------------------------------------------------------------------------------
	//Соеденение с базой данных при вызове класса
	//----------------------------------------------------------------------------------------------
	public function __construct() {
		$this -> dbcnx = mysqli_connect(DB_LOCATION, DB_USER, DB_PASSWORD, DB_NAME);
		if (!$this -> dbcnx) {
			$this -> error = mysqli_connect_error($this -> dbcnx);
			throw new Exception($this -> error);
		}
		mysqli_query($this -> dbcnx, "SET CHARACTER SET utf8;");
	}

	//----------------------------------------------------------------------------------------------
	//Возврат последней MySQL ошибки
	//----------------------------------------------------------------------------------------------
	public function getError() {
		return $this -> error;
	}

	//----------------------------------------------------------------------------------------------
	//Выполение запроса $sql и возврат данных в виде массива
	//----------------------------------------------------------------------------------------------
	public function select($sql) {
		//Выполнение запроса к базе
		$query = mysqli_query($this -> dbcnx, $sql);
		//Если данные в базе не обнаружены
		if (!$query) {
			//Получаем ошибку MySQL
			$this -> error = mysqli_error($this -> dbcnx);
			//Возвращаем неудачу
			return false;
		}
		//Если данные в базе обнаружены
		else {
			if(is_bool($query)) {
				return true;
			}
			else {
				//Обьявляем массив данных
				$arrReturn = array();
				//Проходим по данным базы
				while ($data = mysqli_fetch_assoc($query)) {
					$arrReturn[] = $data;
				}		
				//Возвращаем массив данных
				return $arrReturn;
			}
		}
		/* удаление выборки */
   		mysqli_free_result($query);
	}
	
	//----------------------------------------------------------------------------------------------
	//Добавленние данных в таблицу из массива
	//----------------------------------------------------------------------------------------------
	public function insert($table, $arrFieldValues) {
		//Получаем имена полей в таблице
		$fields = array_keys($arrFieldValues);
		//Получаем значения полей в таблице
		$values = array_values($arrFieldValues);

		$escValues = array();
		foreach ($values as $val) {
			if (!is_numeric($val) && $val != "NOW()" && substr($val, 0, 7) != "ADDDATE") {
				$val = "'" . $val . "'";
				//echo($val."<br>");
			}
			$escValues[] = $val;
		}

		$sql = "INSERT INTO " . $table . " (";
		$sql = $sql . join(", ", $fields);
		$sql = $sql . ") VALUES (";
		$sql = $sql . join(", ", $escValues) . ");";
		$query = mysqli_query($this -> dbcnx, $sql);
		if (!$query) {
			$this -> error = mysqli_error($this -> dbcnx);
			return false;
		} else {
			return true;
		}
	}

	public function delete($table, $arrConditions) {
		$arrWhere = array();
		$counter = 0;
		foreach ($arrConditions as $field => $val) {
			$counter++;
			if (!is_numeric($val)) {
				$val = "'" . $val . "'";
			}
			if ($counter == count($arrConditions)) {
				@$sql = $sql . $field . " = " . $val . ";";
			} else {
				@$sql = $sql . $field . " = " . $val . " AND ";
			}

		}

		$sql = "DELETE FROM " . $table . " WHERE " . $sql;
		$query = mysqli_query($this -> dbcnx, $sql);
		if ($query) {
			return true;
		} else {
			$this -> error = mysqli_error($this -> dbcnx);
			return false;
		}
	}

	public function deletefull($table) {
		$sql = "DELETE FROM " . $table . ";";
		$query = mysqli_query($this -> dbcnx, $sql);
		if (!is_resource($query)) {
			$this -> error = mysqli_error($this -> dbcnx);
			return false;
		} else {
			return true;
		}
	}
	
	
	public function update($table, $arrFieldValues, $arrConditions) {
		$arrUpdate = array();
		foreach ($arrFieldValues as $field => $val) {
			if (!is_numeric($val) && $val != "NOW()" && substr($val, 0, 7) != "ADDDATE") {
				$val = "'" . $val . "'";
			}
			$arrUpdate[] = $field . " = " . $val;
		}

		$arrWhere = array();
		foreach ($arrConditions as $field => $val) {
			if (!is_numeric($val) && $val != "NOW()") {
				$val = "'" . $val . "'";
			}
			$arrWhere[] = $field . " = " . $val;
		}

		$sql = "UPDATE " . $table . " SET " . join(", ", $arrUpdate) . " WHERE " . join(" AND ", $arrWhere);
	 

		if (!mysqli_query($this -> dbcnx, $sql)) {
			$this -> error = mysqli_error($this -> dbcnx);
			return false;
		} else {
			return true;
		}
	}

	public function __destruct() {
		if ($this -> dbcnx) {
			@mysqli_close($this -> dbcnx);
		}
	}

}
