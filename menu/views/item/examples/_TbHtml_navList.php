<?php
echo TbHtml::navList(MenuItem::model()->findByPk($id)->getItems());