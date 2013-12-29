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

/** @var CClientScript $cs */
$cs = Yii::app()->clientScript;
$baseUrl = $this->module->assetsUrl;
$cs->registerCssFile($baseUrl . '/prettify/prettify.css');
$cs->registerScriptFile($baseUrl . '/prettify/prettify.js');
$cs->registerScript('prettify', 'prettyPrint();');

// zii.widgets.CMenu
echo CHtml::tag('h2', array(), Yii::t('menu', 'zii.widgets.CMenu'));
//echo CHtml::tag('p', array(), Yii::t('menu', 'Standard menu using CMenu.'));
$this->renderExample('examples/_CMenu', array('menuItem' => $menuItem));

// bootstrap.widgets.TbNavbar
echo CHtml::tag('h2', array(), Yii::t('menu', 'bootstrap.widgets.TbNavbar'));
$this->renderExample('examples/_TbNavbar', array('menuItem' => $menuItem));

// TbHtml::buttonGroup
echo CHtml::tag('h2', array(), Yii::t('menu', 'TbHtml::buttonGroup'));
echo CHtml::tag('h3', array(), Yii::t('menu', 'Horizontal'));
$this->renderExample('examples/_TbHtml_buttonGroup', array('menuItem' => $menuItem));
echo CHtml::tag('h3', array(), Yii::t('menu', 'Vertical'));
$this->renderExample('examples/_TbHtml_buttonGroupVertical', array('menuItem' => $menuItem));

//// TbHtml::buttonDropdown
echo CHtml::tag('h2', array(), Yii::t('menu', 'TbHtml::buttonDropdown'));
echo CHtml::tag('h3', array(), Yii::t('menu', 'Dropdown'));
$this->renderExample('examples/_TbHtml_buttonDropdown', array('menuItem' => $menuItem));
echo CHtml::tag('h3', array(), Yii::t('menu', 'Dropdown Split'));
$this->renderExample('examples/_TbHtml_buttonDropdownSplit', array('menuItem' => $menuItem));
echo CHtml::tag('h3', array(), Yii::t('menu', 'Dropup'));
$this->renderExample('examples/_TbHtml_buttonDropup', array('menuItem' => $menuItem));

// TbHtml::nav
echo CHtml::tag('h2', array(), Yii::t('menu', 'TbHtml::nav'));
echo CHtml::tag('h3', array(), Yii::t('menu', 'Tabs'));
$this->renderExample('examples/_TbHtml_tabs', array('menuItem' => $menuItem));
echo CHtml::tag('h3', array(), Yii::t('menu', 'Pills'));
$this->renderExample('examples/_TbHtml_pills', array('menuItem' => $menuItem));
echo CHtml::tag('h3', array(), Yii::t('menu', 'Stacked Tabs'));
$this->renderExample('examples/_TbHtml_stackedTabs', array('menuItem' => $menuItem));
echo CHtml::tag('h3', array(), Yii::t('menu', 'Stacked Pills'));
$this->renderExample('examples/_TbHtml_stackedPills', array('menuItem' => $menuItem));
echo CHtml::tag('h3', array(), Yii::t('menu', 'Nav List'));
$this->renderExample('examples/_TbHtml_navList', array('menuItem' => $menuItem));

// bootstrap.widgets.TbNav
echo CHtml::tag('h2', array(), Yii::t('menu', 'bootstrap.widgets.TbNav'));
echo CHtml::tag('h3', array(), Yii::t('menu', 'Tabs'));
$this->renderExample('examples/_TbNav_tabs', array('menuItem' => $menuItem));
echo CHtml::tag('h3', array(), Yii::t('menu', 'Pills'));
$this->renderExample('examples/_TbNav_pills', array('menuItem' => $menuItem));
echo CHtml::tag('h3', array(), Yii::t('menu', 'Stacked Tabs'));
$this->renderExample('examples/_TbNav_stackedTabs', array('menuItem' => $menuItem));
echo CHtml::tag('h3', array(), Yii::t('menu', 'Stacked Pills'));
$this->renderExample('examples/_TbNav_stackedPills', array('menuItem' => $menuItem));
echo CHtml::tag('h3', array(), Yii::t('menu', 'Nav List'));
$this->renderExample('examples/_TbNav_nav', array('menuItem' => $menuItem));
