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

Yii::app()->user->setState('index.menuItem', Yii::app()->request->requestUri);
$this->pageTitle = Yii::t('menu', 'Items');

// links
$this->menu[] = array('label' => Yii::t('menu', 'Refresh'), 'linkOptions' => array('id' => 'reload', 'class' => 'btn btn-default'));
$this->menu[] = array('label' => Yii::t('menu', 'Create'), 'linkOptions' => array('id' => 'add_root', 'class' => 'btn btn-default'));

// menus
$this->widget('menu.widgets.MenuJsTreeWidget', array(
    'modelClassName' => 'MenuItem',
    'themes' => array('theme' => 'default', 'dots' => true, 'icons' => true),
    'plugins' => array('themes', 'html_data', 'contextmenu', 'crrm', 'dnd', 'cookies', 'ui')
));
