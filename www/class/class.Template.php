<?php

class Template {
	private $templatePath;
	private $arrTemplate;
	private $arrDynTemplate;
	private $arrValues;
	private $mainFile;
	private $objDB;

	public function __construct($templatePath) {
		if (@$_COOKIE['theme']) {
			$templatePath = "themes/" . $_COOKIE['theme'];
		}
		if (@$_GET["theme"]) {
			setcookie("theme", $_GET['theme']);
			$templatePath = "themes/" . $_GET['theme'];
		}
		if (!is_dir($templatePath)) {
			$templatePath = "themes/shoppe_original";
		}
		$this -> templatePath = $templatePath . "/tpl";
		$this -> defineMain();

	}

	public function defineMain($mainFile = "html.tpl") {
		if (is_file($this -> templatePath . "/" . $mainFile)) {
			$this -> mainFile = file_get_contents($this -> templatePath . "/" . $mainFile);
		}

	}

	//Определяем шаблоны
	public function define($arrTemplate) {
		if (is_array($arrTemplate)) {
			foreach ($arrTemplate as $keyTemplate => $valTemplate) {
				if (is_file($this -> templatePath . "/" . $valTemplate)) {
					$this -> arrTemplate[$keyTemplate] = file_get_contents($this -> templatePath . "/" . $valTemplate);
				}
			}
		}
	}

	public function defineDynamic($arrTemplate) {
		if (is_array($arrTemplate)) {
			foreach ($arrTemplate as $keyTemplate => $valTemplate) {
				if (is_file($this -> templatePath . "/" . $valTemplate)) {
					$file = file_get_contents($this -> templatePath . "/" . $valTemplate);
					$temp = explode("<!--DEFINE ", $file);
					$keyTemplate = Array();
					for ($i = 1; $i <= count($temp) - 1; $i++) {
						$val = explode("-->", $temp[$i]);
						$keyTemplate[$val[0]] = $val[0];
					}
					foreach ($keyTemplate as $key => $val) {
						$this -> arrDynTemplate[$key] = substr($file, strpos($file, "<!--DEFINE " . $key . "-->"), (strpos($file, "<!--END " . $key . "-->") - strpos($file, "<!--DEFINE " . $key . "-->")));
					}

				}
			}
			return $this -> arrDynTemplate;
		}
	}

	public function addDynamic($sTemplate, $arrValues) {
		if (is_array($arrValues)) {
			$file = file_get_contents($this -> templatePath . "/" . $sTemplate);
			foreach ($arrValues as $keyValue => $valValue) {
				$file = str_replace("{" . $keyValue . "}", $valValue, $file);
			}
			return $file;
		}
	}

	//Устанавливаем переменные для замены в шаблонах
	public function assign($arrValues) {
		if (is_array($arrValues)) {
			foreach ($arrValues as $key => $val) {
				$this -> arrValues[$key] = $val;
			}
		}
	}

	public function success($string) {
		$this -> define(Array("MAIN_CONTENT" => "messages/success.tpl"));
		$this -> assign(Array("SUCCESS_CONTENT" => $string));
		$GLOBALS['serviceMessage'] = true;
	}

	public function error($string) {
		$this -> define(Array("MAIN_CONTENT" => "messages/error.tpl"));
		$this -> assign(Array("ERROR_CONTENT" => $string));
		$GLOBALS['serviceMessage'] = true;
	}

	public function warning($string) {
		$this -> define(Array("MAIN_CONTENT" => "messages/warning.tpl"));
		$this -> assign(Array("WARNING_CONTENT" => $string));
		$GLOBALS['serviceMessage'] = true;
	}

	public function templatePrint() {
		$i = 0;
		do {
			if (is_array($this -> arrTemplate)) {
				foreach ($this->arrTemplate as $keyTemplate => $valTemplate) {
					$this -> mainFile = str_replace("{" . $keyTemplate . "}", $valTemplate, $this -> mainFile);
				}
			} else {
				foreach ($this->arrValues as $keyValues => $valValues) {
					$this -> mainFile = str_replace("{" . $keyValues . "}", $valValues, $this -> mainFile);
				}
			}

			$i++;
		} while($i<2);
		if (is_array($this -> arrTemplate)) {
			foreach ($this->arrTemplate as $keyTemplate => $valTemplate) {
				foreach ($this->arrValues as $keyValue => $valValue) {
					if (substr($keyValue, 0, 1) == ".") {

					} else {
						$this -> arrTemplate[$keyTemplate] = str_replace("{" . $keyValue . "}", $valValue, $this -> arrTemplate[$keyTemplate]);
					}

					$this -> mainFile = str_replace("{" . $keyValue . "}", $valValue, $this -> mainFile);
				}
			}
		}

		$_LANG = $GLOBALS['_LANG'];
		if (is_array($_LANG)) {
			foreach ($_LANG as $key => $val) {
				$this -> mainFile = str_replace("{" . $key . "}", $val, $this -> mainFile);
			}
		}

		$cssPath = str_replace("/tpl", "", $this -> templatePath);
		$this -> mainFile = str_replace("{THEME_PATH}", $cssPath, $this -> mainFile);

		echo($this -> mainFile);
	}

}
?>
