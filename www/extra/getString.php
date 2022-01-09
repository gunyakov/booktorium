<?php

function getString($string, $len = 30) {
	if (strlen($string) > $len) {
		$string = substr($string, 0, $len - 1) . "...";
	}
	return $string;
}

function UR_exists($url){
    $headers=get_headers($url);
    return stripos($headers[0],"200 OK")?true:false;
}

function remote_file_exists($url){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if( $httpCode == 200 ){return true;}
    return false;
}
?>
