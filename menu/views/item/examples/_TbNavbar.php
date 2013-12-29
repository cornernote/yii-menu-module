<?php
$this->widget('bootstrap.widgets.TbNavbar', array(
    'brandLabel' => 'Title',
    'display' => null, // default is static to top
    'items' => array(
        array(
            'class' => 'bootstrap.widgets.TbNav',
            'items' => MenuItem::model()->findByPk($id)->getItems(),
        ),
    ),
));
?>