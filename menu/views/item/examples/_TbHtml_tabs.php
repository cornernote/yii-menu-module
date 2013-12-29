<?php
echo TbHtml::tabs(MenuItem::model()->findByPk($id)->getItems());