<?php
echo TbHtml::stackedTabs(MenuItem::model()->findByPk($id)->getItems());
?>