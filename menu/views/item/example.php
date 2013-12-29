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

$this->pageTitle = Yii::t('email', ':label (ID-:id)', array(':label' => $menuItem->label, ':id' => $menuItem->id));

/** @var CClientScript $cs */
$cs = Yii::app()->clientScript;
$baseUrl = $this->module->assetsUrl;
$cs->registerCssFile($baseUrl . '/prettify/prettify.css');
$cs->registerScriptFile($baseUrl . '/prettify/prettify.js');
$cs->registerScript('prettify', 'prettyPrint();');


$this->widget('bootstrap.widgets.TbTabs', array(
    'type' => TbHtml::NAV_TYPE_PILLS,
    'tabs' => array(
        array(
            'label' => Yii::t('menu', 'CMenu'),
            'content' => $this->renderExample('examples/_CMenu', array('id' => $menuItem->id), true),
            'active' => true,
        ),
        array(
            'label' => Yii::t('menu', 'CHtml::link'),
            'content' => CHtml::tag('h3', array(), Yii::t('menu', 'Links'))
                . $this->renderExample('examples/_CHtml_link', array('id' => $menuItem->id), true)
                . CHtml::tag('h3', array(), Yii::t('menu', 'Button Class'))
                . $this->renderExample('examples/_CHtml_linkClass', array('id' => $menuItem->id), true),
        ),
        array(
            'label' => Yii::t('menu', 'TbHtml::buttonGroup'),
            'content' => CHtml::tag('h3', array(), Yii::t('menu', 'Horizontal'))
                . $this->renderExample('examples/_TbHtml_buttonGroup', array('id' => $menuItem->id), true)
                . CHtml::tag('h3', array(), Yii::t('menu', 'Vertical'))
                . $this->renderExample('examples/_TbHtml_buttonGroupVertical', array('id' => $menuItem->id), true),
        ),
        array(
            'label' => Yii::t('menu', 'TbHtml::buttonDropdown'),
            'content' => CHtml::tag('h3', array(), Yii::t('menu', 'Dropdown'))
                . $this->renderExample('examples/_TbHtml_buttonDropdown', array('id' => $menuItem->id), true)
                . CHtml::tag('h3', array(), Yii::t('menu', 'Dropdown Split'))
                . $this->renderExample('examples/_TbHtml_buttonDropdownSplit', array('id' => $menuItem->id), true)
                . CHtml::tag('h3', array(), Yii::t('menu', 'Dropup'))
                . $this->renderExample('examples/_TbHtml_buttonDropup', array('id' => $menuItem->id), true),
        ),
        array(
            'label' => Yii::t('menu', 'TbHtml::nav'),
            'content' => CHtml::tag('h3', array(), Yii::t('menu', 'Tabs'))
                . $this->renderExample('examples/_TbHtml_tabs', array('id' => $menuItem->id), true)
                . CHtml::tag('h3', array(), Yii::t('menu', 'Pills'))
                . $this->renderExample('examples/_TbHtml_pills', array('id' => $menuItem->id), true)
                . CHtml::tag('h3', array(), Yii::t('menu', 'Stacked Tabs'))
                . $this->renderExample('examples/_TbHtml_stackedTabs', array('id' => $menuItem->id), true)
                . CHtml::tag('h3', array(), Yii::t('menu', 'Stacked Pills'))
                . $this->renderExample('examples/_TbHtml_stackedPills', array('id' => $menuItem->id), true)
                . CHtml::tag('h3', array(), Yii::t('menu', 'Nav List'))
                . $this->renderExample('examples/_TbHtml_navList', array('id' => $menuItem->id), true),
        ),
        array(
            'label' => Yii::t('menu', 'TbNav'),
            'content' => CHtml::tag('h3', array(), Yii::t('menu', 'Tabs'))
                . $this->renderExample('examples/_TbNav_tabs', array('id' => $menuItem->id), true)
                . CHtml::tag('h3', array(), Yii::t('menu', 'Pills'))
                . $this->renderExample('examples/_TbNav_pills', array('id' => $menuItem->id), true)
                . CHtml::tag('h3', array(), Yii::t('menu', 'Stacked Tabs'))
                . $this->renderExample('examples/_TbNav_stackedTabs', array('id' => $menuItem->id), true)
                . CHtml::tag('h3', array(), Yii::t('menu', 'Stacked Pills'))
                . $this->renderExample('examples/_TbNav_stackedPills', array('id' => $menuItem->id), true)
                . CHtml::tag('h3', array(), Yii::t('menu', 'Nav List'))
                . $this->renderExample('examples/_TbNav_nav', array('id' => $menuItem->id), true),
        ),
        array(
            'label' => Yii::t('menu', 'TbNavbar'),
            'content' => $this->renderExample('examples/_TbNavbar', array('id' => $menuItem->id), true),
        ),
    ),
));
