<?php
echo TbHtml::buttonGroup(MenuItem::model()->findByPk($id)->getItems(), array('vertical' => true));
?>