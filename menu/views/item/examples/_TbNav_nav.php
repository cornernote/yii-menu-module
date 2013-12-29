<?php
$this->widget('bootstrap.widgets.TbNav', array(
    'type' => TbHtml::NAV_TYPE_LIST,
    'items' => MenuItem::model()->findByPk($id)->getItems(2),
));
?>