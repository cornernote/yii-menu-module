<?php
/**
 * @var $this MenuItemController
 * @var $menuItem MenuItem
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-menu-module
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-menu-module/master/LICENSE
 *
 * @package yii-menu-module
 */

$this->pageTitle = Yii::t('menu', 'Examples');

$menuItem = MenuItem::model()->findByPk(3);
$this->widget('zii.widgets.CMenu', array('items' => $menuItem->getItems(array(), 0)));

echo TbHtml::codeBlock("\$this->widget('zii.widgets.CMenu', array('items' => MenuItem::model()->findByPk(X)->getItems()));");