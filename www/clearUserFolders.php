<?php
error_reporting(E_ALL); // Вывод ошибок.
function cleanFolder($path) {
	$arrDirs = scandir($path);
	$fileCount = 0;
	$dirCount = 0;
	if (is_array($arrDirs)) {
		foreach ($arrDirs as $key => $val) {
			if (is_dir($path  . $val) && $val != "." && $val != "..") {
				$dirCount++;
				//if(!is_dir(FILES_COLD_STORAGE.$val)) {
					//mkdir(FILES_COLD_STORAGE.$val, MKDIR_MODE);
				//}
				$arrFiles = scandir($path  . $val);
				if (is_array($arrFiles)) {
					foreach ($arrFiles as $key2 => $val2) {
						if (is_file($path  . $val . "/" . $val2)) {
							//if(!is_file(FILES_COLD_STORAGE.$val."/".$val2)) {
								//copy($path  . $val . "/" . $val2);
							//}
							if(substr($val2, -3) != "txt") {
								$fileCount++;
								unlink($path  . $val . "/" . $val2);
							}	
						}
					}
				}
				rmdir($path . $val);
			}
		}
	}
	echo("<br><b>".$path."</b><br>Folder(s) deleted: " . $dirCount . " File(s) deleted: " . $fileCount);
}

require_once "initd.php";
$objDB -> select("TRUNCATE TABLE tiffImageList;");
cleanFolder(USER_IMAGE_STORAGE);
cleanFolder(FILES_SIMLINK_STORAGE);
?>
