<?php
echo TbHtml::pills(MenuItem::model()->findByPk($id)->getItems());
?>