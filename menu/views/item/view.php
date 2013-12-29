<?php
/**
 * @var $this MenuItemController
 * @var $model MenuItem
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-menu-module
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-menu-module/master/LICENSE
 *
 * @package yii-menu-module
 */

$this->pageTitle = Yii::t('email', 'Item ID-:id', array(':id' => $model->id));

$attributes = array();
$attributes[] = array(
    'name' => 'id',
);
$attributes[] = array(
    'name' => 'label',
);
$attributes[] = array(
    'name' => 'icon',
);
$attributes[] = array(
    'name' => 'url',
);
$attributes[] = array(
    'name' => 'url_params',
);
$attributes[] = array(
    'name' => 'target',
);
$attributes[] = array(
    'name' => 'access_role',
);
$attributes[] = array(
    'name' => 'enabled',
    'value' => $model->getEnabledIcon(),
    'type' => 'raw',
);

$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => $attributes,
    'htmlOptions' => array(
        'class' => 'table table-condensed table-striped',
    ),
));

echo CHtml::tag('div', array('class' => 'text-center'), CHtml::link(Yii::t('menu', 'View Examples'), array('example', 'id' => $model->id), array('class' => 'btn btn-primary')));
