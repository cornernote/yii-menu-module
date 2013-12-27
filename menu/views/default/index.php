<?php
/**
 * @var $this DefaultController
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-menu-module
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-menu-module/master/LICENSE
 *
 * @package yii-menu-module
 */

$this->pageTitle = $this->module->getName();
$this->pageHeading = false;

$content = CHtml::tag('p', array(), Yii::t('menu', 'You may use the following tools to manage your menus.'));
foreach (array_keys($this->module->controllerMap) as $controllerName)
    $content .= ' ' . TbHtml::link(Yii::t('menu', ucfirst($controllerName)), array($controllerName . '/index'), array('class' => 'btn btn-large btn-primary'));
$this->widget('bootstrap.widgets.TbHeroUnit', array(
    'heading' => $this->module->getName(),
    'content' => $content,
));