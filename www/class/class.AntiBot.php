<?php

class AntiBot {
	private $objDB;
	private $varValue;
	private $varLength = 6;
	private $im;
	private $background_color;
	private $text_color;

	public function __construct() {
		$this -> objDB = $GLOBALS['objDB'];
		$this -> objDB -> select("DELETE FROM antiBotCode WHERE UNIX_TIMESTAMP(datePut) + 300 < UNIX_TIMESTAMP(NOW());");
	}

	public function getCode($code) {
		if (empty($code)) {
			return false;
		} else {
			$data = $this -> objDB -> select("SELECT code, UNIX_TIMESTAMP(datePut) as stamp, ID FROM antiBotCode WHERE code='" . $code . "';");
			if (@$data[0]['code'] == $code) {
				if ($data[0]['stamp'] - time() > 5 * 60) {
					return false;
				} else {
					$this -> objDB -> select("DELETE FROM antiBotCode WHERE code='" . $code . "';");
					return true;
				}
			} else {
				return false;
			}
		}
	}

	public function setCode() {
		$this -> varValue = "";
		for ($i = 0; $i < $this -> varLength; $i++) {
			$this -> varValue = $this -> varValue . rand(0, 9);
		}
		$this -> varValue = round($this -> varValue);
		$this -> objDB -> insert("antiBotCode", array("code" => $this -> varValue, "datePut" => "NOW()"));
	}

	public function getImage() {
		$this -> setCode();
		//echo($this -> varValue);
		header ("Content-type: image/png");
		$im = imagecreate(150, 40);
		$red = @$_GET['red'];
		if(!is_numeric($red)) $red = 255;
		$blue = @$_GET['blue'];
		if(!is_numeric($blue)) $blue = 255;
		$green = @$_GET['green'];
		if(!is_numeric($green)) $green = 255;
		$bgc = imagecolorallocate($im, $red, $green, $blue);
		$white = imagecolorallocate($im, 0, 0, 0);
		imagettftext($im, 25, 0, 10, 30, $white, "./font.ttf", $this -> varValue);
		imagepng($im);
		imagedestroy($im);		
	}

}
?>
