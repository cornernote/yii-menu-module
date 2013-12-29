<?php
echo TbHtml::stackedPills(MenuItem::model()->findByPk($id)->getItems());
?>