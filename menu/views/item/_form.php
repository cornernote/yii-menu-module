<?php
/**
 * @var $this MenuItemController
 * @var $model MenuItem
 * @var $parent_id int
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-menu-module
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-menu-module/master/LICENSE
 *
 * @package yii-menu-module
 */

echo CHtml::tag('div', array(
    'id' => 'success-note',
    'class' => 'alert alert-success',
    'style' => 'display:none;'
), ($model->isNewRecord ? Yii::t('menu', 'MenuItem has been created successfully.') : Yii::t('menu', 'MenuItem  has been updated successfully.')));

/** @var MenuActiveForm $form */
$form = $this->beginWidget('menu.widgets.MenuActiveForm', array(
        'id' => 'menuItem-form',
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
        'htmlOptions' => array('class' => 'ajax-form'),
        'action' => $model->isNewRecord ? (isset($_POST['create_root']) ? array('item/createRoot') : array('item/createNode')) : array('item/updateNode', 'id' => $model->id),
        'enableClientValidation' => true,
        'focus' => array($model, 'label'),
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnType' => false,
            'inputContainer' => '.control-group',
            'errorCssClass' => 'error',
            'successCssClass' => 'success',
            'afterValidate' => 'js:function(form,data,hasError){$.js_afterValidate(form,data,hasError);  }',
        ),
    )
);
echo $form->errorSummary($model);

if (!$model->isNewRecord)
    echo CHtml::hiddenField('update_id', $model->id);

if (isset($_POST['name']))
    $model->label = $_POST['name'];
if (isset($_POST['parent_id']))
    echo CHtml::hiddenField('parent_id', $_POST['parent_id']);

//$model->parent_id = isset($_POST['parent_id']);
//echo $form->dropDownListControlGroup($model, 'parent_id', MenuItem::model()->getDropDown(), array('empty' => ''));

echo $form->textFieldControlGroup($model, 'label');
echo $form->textFieldControlGroup($model, 'icon');
echo $form->textFieldControlGroup($model, 'url');
echo $form->textFieldControlGroup($model, 'url_params');
echo $form->textFieldControlGroup($model, 'target');
echo $form->textFieldControlGroup($model, 'access_role');
echo $form->checkBoxControlGroup($model, 'enabled');

echo $form->getSubmitButtonRow($model->isNewRecord ? Yii::t('menu', 'Create') : Yii::t('menu', 'Save'));
$this->endWidget();
