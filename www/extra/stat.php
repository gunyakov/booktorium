<?php
//Если модуль статистики разрешен
if (STAT_MODULE) {
	//Ведение логов пользовательского агента
	$data = $objDB -> select("SELECT * FROM statAgentLog WHERE userAgent LIKE '" . $_SERVER['HTTP_USER_AGENT'] . "' AND datePut = CURDATE() AND ip LIKE '" . $_SERVER['REMOTE_ADDR'] . "';");
	if ($data) {
		$objDB -> select("UPDATE statAgentLog SET count = count + 1, dateLast = NOW() WHERE ID=" . $data[0]["ID"] . ";");
	} else {
		$objDB -> insert("statAgentLog", Array("userAgent" => $_SERVER['HTTP_USER_AGENT'], "datePut" => "NOW()", "dateLast" => "NOW()", "ip" => $_SERVER['REMOTE_ADDR']));
		$data = $objDB -> select("SELECT * FROM statAgentLog WHERE userAgent LIKE '" . $_SERVER['HTTP_USER_AGENT'] . "' AND datePut = CURDATE() AND ip LIKE '" . $_SERVER['REMOTE_ADDR'] . "';");
	}
	
	if($data) {
		$agentInfo = $data[0];
		$data = $objDB->select("SELECT * FROM statQueryLog WHERE agentID = ".$agentInfo['ID']." AND query LIKE '".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."' AND datePut = CURDATE();");
		if($data) {
			$objDB->select("UPDATE statQueryLog SET count = count + 1, lastDate = NOW() WHERE ID = ".$data[0]['ID'].";");
		}
		else {
			$objDB ->insert("statQueryLog", Array("query" => $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], "agentID" => $agentInfo['ID'], "datePut" => "NOW()", "lastDate" => "NOW()"));
		}		
	}
	//foreach($_SERVER as $key => $val){
		//echo($key."=>".$val."<br/>");
	//}
	//echo($_SERVER['PHP_SELF']);
}
?>