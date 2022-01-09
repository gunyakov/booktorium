<?php
class User {
	public function __construct() {
		
	}
	
	public function getFolder($userID) {
		if(is_numeric($userID)) {
			$objDB = $GLOBALS['objDB'];
			$data = $objDB->select("SELECT name FROM user WHERE ID=".$userID.";");
			if($data) {
				return USER_UPLOAD_STORAGE.md5($data[0]['name'])."/";
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}
	}
	
	public function getFolderByBook($bookID) {
		if(is_numeric($bookID)) {
			$objDB = $GLOBALS['objDB'];
			$data = $objDB->select("SELECT user.name FROM user, tempBookList WHERE tempBookList.ID = ".$bookID." AND tempBookList.userID = user.ID;");
			if($data) {
				return USER_UPLOAD_STORAGE.md5($data[0]['name'])."/";
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}
	}
	public function __destruct() {
		
	}
}
?>