<?php
$this->widget('bootstrap.widgets.TbNav', array(
    'type' => TbHtml::NAV_TYPE_PILLS,
    'items' => MenuItem::model()->findByPk($id)->getItems(),
));