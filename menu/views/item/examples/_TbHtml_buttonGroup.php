<?php
echo TbHtml::buttonGroup(MenuItem::model()->findByPk($id)->getItems());
?>