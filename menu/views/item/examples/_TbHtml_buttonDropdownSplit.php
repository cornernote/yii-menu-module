<?php
$menuItem = MenuItem::model()->findByPk($id);
echo TbHtml::buttonDropdown($menuItem->label, $menuItem->getItems(1), array(
    'split' => true,
));
?>