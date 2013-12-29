<?php
$menuItem = MenuItem::model()->findByPk($id);
$this->widget('bootstrap.widgets.TbNavbar', array(
    'brandLabel' => $menuItem->label,
    'display' => null, // default is static to top
    'items' => array(
        array(
            'class' => 'bootstrap.widgets.TbNav',
            'items' => $menuItem->getItems(),
        ),
    ),
));