<?php

/**
 *   JsTreeWidget  class file.
 *
 * @author Spiros Kabasakalis <kabasakalis@gmail.com>
 * @link http://iws.kabasakalis.gr/
 * @link http://www.reverbnation.com/spiroskabasakalis
 * @copyright Copyright &copy; 2013 Spiros Kabasakalis
 * @since 1.0
 * @license  http://opensource.org/licenses/MIT  The MIT License (MIT)
 * @version 1.0.0
 */
class MenuJsTreeWidget extends CWidget
{

    /**
     * @var string the model class name with the NestedSetBehavior
     */
    public $modelClassName;

    /**
     * @var string theme configuration
     * @link  http://www.jstree.com/documentation/themes
     */
    public $themes = array('theme' => 'default', 'dots' => true, 'icons' => true);

    /**
     * @var string plugins  configuration
     * @link http://www.jstree.com/demo
     *  If you want to disable tree manipulation (for example if rendering tree on frontend),just exclude contextmenu,crrm and dnd plugins.
     */
    public $plugins = array('themes', 'html_data', 'contextmenu', 'crrm', 'dnd', 'cookies', 'ui');


    /**
     *
     */
    public function init()
    {
        $this->registerAssets();
        parent::init();
    }

    /**
     *
     */
    private function registerAssets()
    {

        //assuming that we use the widget in  controller with JsTreeBehavior
        $controllerID = isset($this->controller->module) ? $this->controller->module->id . '/' . $this->controller->id : $this->controller->id;

        //pass php variables to javascript
        $jstree_behavior_js = '(function ($) { JsTreeBehavior = ' . json_encode(array(
                'controllerID' => $controllerID,
                'container_ID' => $this->id,
                'open_nodes' => $this->getOpenNodes(),
                'themes' => $this->themes,
                'plugins' => $this->plugins,
                'urlFormat' => Yii::app()->urlManager->urlFormat,
                'csrfToken' => Yii::app()->request->csrfToken,
                'url' => array(
                    'fetchTree' => Yii::app()->createUrl($controllerID . '/fetchTree'),
                    'returnForm' => Yii::app()->createUrl($controllerID . '/returnForm'),
                    'returnView' => Yii::app()->createUrl($controllerID . '/returnView'),
                    'rename' => Yii::app()->createUrl($controllerID . '/rename'),
                    'remove' => Yii::app()->createUrl($controllerID . '/remove'),
                    'moveCopy' => Yii::app()->createUrl($controllerID . '/moveCopy'),
                ),
            )) . '; }(jQuery));';


        $clientScript = Yii::app()->clientScript;
        $assetsUrl = Yii::app()->getModule('menu')->getAssetsUrl();
        //uncomment to register jquery only if you have not already registered it somewhere else in your application
        //$clientScript->registerCoreScript('jquery');

        //uncomment to register bootstrap css if you have not already included  it (optional),or else you will have to style the html by yourself.
        //$clientScript->registerCssFile($assetsUrl . '/bootstrap/css/bootstrap.css');
        $clientScript->registerCoreScript('cookie');
        $clientScript->registerScript(__CLASS__ . 'jstree_behavior_params', $jstree_behavior_js, CClientScript::POS_END);

        //modal dialog with noty.js
        $clientScript->registerScriptFile($assetsUrl . '/noty/js/noty/jquery.noty.js', CClientScript::POS_END);
        $clientScript->registerScriptFile($assetsUrl . '/noty/js/noty/layouts/center.js', CClientScript::POS_END);
        $clientScript->registerScriptFile($assetsUrl . '/noty/js/noty/themes/default.js', CClientScript::POS_END);
        //js spinner
        $clientScript->registerScriptFile($assetsUrl . '/js/spin.min.js', CClientScript::POS_END);
        //fancybox
        $clientScript->registerScriptFile($assetsUrl . '/fancybox2/jquery.fancybox.js', CClientScript::POS_END);
        $clientScript->registerCssFile($assetsUrl . '/fancybox2/jquery.fancybox.css');

        $clientScript->registerScriptFile($assetsUrl . '/json2/json2.js');

        $clientScript->registerCoreScript('yiiactiveform');

        // jquery.form.js plugin http://malsup.com/jquery/form/
        $clientScript->registerScriptFile($assetsUrl . '/js/jquery-migrate-1.2.1.js', CClientScript::POS_END);
        $clientScript->registerScriptFile($assetsUrl . '/js/jquery.form.js', CClientScript::POS_END);
        $clientScript->registerScriptFile($assetsUrl . '/js/form.js', CClientScript::POS_END);
        //jstree
        $clientScript->registerScriptFile($assetsUrl . '/jstree/jquery.jstree.js', CClientScript::POS_END);
        $clientScript->registerScriptFile($assetsUrl . '/js/jstree.behavior.js', CClientScript::POS_END);
    }

    /**
     * Specify which nodes to open.Default is all but you can modify.
     * @return  string  $open_nodes  all the open nodes with node ids delimited by comma.
     */
    private function getOpenNodes()
    {
        $categories = CActiveRecord::model($this->modelClassName)->findAll(array('order' => 'lft'));
        $open_nodes = array();
        foreach ($categories as $n => $category) {
            $open_nodes[] = 'node_' . $category->id;
        }
        return $open_nodes;
    }

    /**
     *
     */
    public function run()
    {
        echo CHtml::tag('div', array('class' => 'well', 'style' => 'margin-top: 20px', 'id' => $this->id));
    }

}

