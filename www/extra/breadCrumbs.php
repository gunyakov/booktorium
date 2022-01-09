<?php
function createBreadCrumbs($parrentID) {
	if ($parrentID != 0) {
		$data = $GLOBALS['objDB'] -> select("SELECT * FROM categoryList WHERE ID='" . $parrentID . "';");
		$strBreadCrumbs = '';
		if ($data) {
			$strBreadCrumbs = createBreadCrumbs($data[0]['parentID']) . $GLOBALS['objTheme'] -> addDynamic("breadCrumbsPrev.tpl", $data[0]);
		}

		return $strBreadCrumbs;
	}

}
?>