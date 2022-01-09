<?php
//Устанавливаем, что мы выводим список категорий в виде таблицы
$objTheme -> define(Array("CATEGORY_TREE" => "showCategory.php/tree.tpl"));
$treeCategory = '';
foreach ($data as $key => $val) {
	if (@empty($val['descr'])) {
		$val['descr'] = "[{LANG_HAVE_NO_ELEMENT}]";
	}
	$val['link'] = "showCategory.php?id=" . $val['ID'];
	$treeCategory .= $objTheme -> addDynamic("showCategory.php/treeItem.tpl", $val);
}
$objTheme -> assign(Array("CATEGORY_TREE_CONTENT" => $treeCategory, "MENU" => ""));

/*$objTheme -> define(Array("MENU" => "menu.tpl", "CATEGORY_TREE" => "categoryTree.tpl"));
$objTheme -> assign(Array("MENU" => ""));
$menuCategory = '';
foreach ($data as $key => $val) {
	if (@empty($val['descr'])) {
		$val['descr'] = "[{LANG_HAVE_NO_ELEMENT}]";
	}
	$val['link'] = "showCategory.php?id=" . $val['ID'];
	$menuCategory .= $objTheme -> addDynamic("menuItemCategory.tpl", $val);
}
$objTheme -> assign(Array("MENU_CONTENT" => $menuCategory));*/
?>
