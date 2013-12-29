<?php
$this->widget('zii.widgets.CMenu', array(
    'items' => MenuItem::model()->findByPk($id)->getItems(),
));