<?php

function formatFileSize($fileSize) {
	switch($fileSize) {
		case $fileSize > (1024 * 1024) :
			$fileSize = round($fileSize / (1024 * 1024), 2) . " MB";
			break;
		case $fileSize < (1024 * 1024) :
			$fileSize = round($fileSize / 1024) . " KB";
			break;
	}
	return $fileSize;
}
?>