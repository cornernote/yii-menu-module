<?php

/**
 * SiteController for Tests
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-email-module
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-email-module/master/LICENSE
 *
 * @package yii-email-module
 */
class SiteController extends CController
{

    public function actionIndex()
    {
        // init YiiBooster
        Yii::app()->getComponent('bootstrap');
        // render a widget only found in YiiBooster
        $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'hello world',
            'type' => 'primary',
        ));
        //$this->renderText('hello world!');
    }

}