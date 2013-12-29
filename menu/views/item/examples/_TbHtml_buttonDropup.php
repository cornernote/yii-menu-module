<?php echo TbHtml::buttonDropdown($menuItem->label, $menuItem->getItems(1), array(
    'split' => true,
    'dropup' => true,
    'menuOptions' => array('pull' => TbHtml::PULL_RIGHT),
)); ?>