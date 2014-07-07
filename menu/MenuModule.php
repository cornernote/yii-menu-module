<?php

/**
 * MenuModule
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-menu-module
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-menu-module/master/LICENSE
 *
 * @package yii-menu-module
 */
class MenuModule extends CWebModule
{
    /**
     * @var string
     */
    public $defaultController = 'item';

    /**
     * @var string The ID of the CDbConnection application component. If not set, a SQLite3
     * database will be automatically created in <code>protected/runtime/menu-MenuVersion.db</code>.
     */
    public $connectionID;

    /**
     * @var string The ID of the CCache application component. If not set, cache is not used.
     */
    public $cacheID;

    /**
     * @var boolean Whether the DB tables should be created automatically if they do not exist. Defaults to true.
     * If you already have the table created, it is recommended you set this property to be false to improve performance.
     */
    public $autoCreateTables = true;

    /**
     * @var string The layout used for module controllers.
     */
    public $layout = 'menu.views.layouts.column1';

    /**
     * @var array mapping from controller ID to controller configurations.
     */
    public $controllerMap = array(
        'item' => 'menu.controllers.MenuItemController',
    );

    /**
     * @var array Map of model info including relations and behaviors.
     */
    public $modelMap = array();

    /**
     * @var array Defines the access filters for the module.
     * The default is MenuAccessFilter which will allow any user listed in MenuModule::adminUsers to have access.
     */
    public $controllerFilters = array(
        'menuAccess' => array('menu.components.MenuAccessFilter'),
    );

    /**
     * @var array A list of users who can access this module.
     */
    public $adminUsers = array();

    /**
     * @var string The path to YiiStrap.
     * Only required if you do not want YiiStrap in your app config, for example, if you are running YiiBooster.
     * Only required if you did not install using composer.
     * Please note:
     * - You must download YiiStrap even if you are using YiiBooster in your app.
     * - When using this setting YiiStrap will only loaded in the menu interface (eg: index.php?r=menu).
     */
    public $yiiStrapPath;

    /**
     * @var CDbConnection the DB connection instance
     */
    private $_db;

    /**
     * @var CCache the cache instance
     */
    private $_cache;

    /**
     * @var string Url to the assets
     */
    private $_assetsUrl;

    /**
     * @return string
     */
    public static function powered()
    {
        return Yii::t('menu', 'Powered by {yii-menu-module}.', array('{yii-menu-module}' => '<a href="http://cornernote.github.io/yii-menu-module/" rel="external">Yii Menu Module</a>'));
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return trim(file_get_contents(dirname(__FILE__) . '/version.txt'));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Menu';
    }

    /**
     * Initializes the menu module.
     */
    public function init()
    {
        parent::init();

        // setup paths
        $this->setImport(array(
            'menu.models.*',
            'menu.components.*',
        ));

        // map models
        foreach ($this->getDefaultModelMap() as $method => $data)
            foreach ($data as $name => $options)
                if (empty($this->modelMap[$method][$name]))
                    $this->modelMap[$method][$name] = $options;

        // init yiiStrap
        $this->initYiiStrap();
    }

    /**
     * @return array
     */
    public function getDefaultModelMap()
    {
        return array(
            'MenuItem' => array(
                'behaviors' => array(
                    'NestedSetBehavior' => array(
                        'class' => 'menu.behaviors.MenuNestedSetBehavior',
                        'hasManyRoots' => true,
                    ),
                ),
            ),
        );
    }

    /**
     * @return CDbConnection the DB connection instance
     * @throws CException if {@link connectionID} does not point to a valid application component.
     */
    public function getDbConnection()
    {
        if ($this->_db !== null)
            return $this->_db;
        elseif (($id = $this->connectionID) !== null) {
            if (($this->_db = Yii::app()->getComponent($id)) instanceof CDbConnection)
                return $this->_db;
            else
                throw new CException(Yii::t('menu', 'MenuModule.connectionID "{id}" is invalid. Please make sure it refers to the ID of a CDbConnection application component.',
                    array('{id}' => $id)));
        }
        else {
            $dbFile = Yii::app()->getRuntimePath() . DIRECTORY_SEPARATOR . 'menu-' . $this->getVersion() . '.db';
            return $this->_db = new CDbConnection('sqlite:' . $dbFile);
        }
    }

    /**
     * Sets the DB connection used by the Menu module
     * @param CDbConnection $value the DB connection instance
     */
    public function setDbConnection($value)
    {
        $this->_db = $value;
    }

    /**
     * @return CCache the cache instance
     * @throws CException if {@link cache} does not point to a valid application component.
     */
    public function getCache()
    {
        if ($this->_cache !== null)
            return $this->_cache;
        elseif (($id = $this->cacheID) !== null) {
            if (($this->_cache = Yii::app()->getComponent($id)) instanceof CCache)
                return $this->_cache;
            else
                throw new CException(Yii::t('menu', 'MenuModule.cacheID "{id}" is invalid. Please make sure it refers to the ID of a CCache application component.',
                    array('{id}' => $id)));
        }
        else {
            return false;
        }
    }

    /**
     * Sets the cache component used by the module
     * @param CCache $value the cache instance
     */
    public function setCache($value)
    {
        $this->_cache = $value;
    }

    /**
     * @return string the base URL that contains all published asset files of menu.
     */
    public function getAssetsUrl()
    {
        if ($this->_assetsUrl === null) {
            /** @var CAssetManager $assetManager */
            $assetManager = Yii::app()->getAssetManager();
            $this->_assetsUrl = $assetManager->publish(Yii::getPathOfAlias('menu.assets'), false, -1, YII_DEBUG);
        }
        return $this->_assetsUrl;
    }

    /**
     * @param string $value the base URL that contains all published asset files of menu.
     */
    public function setAssetsUrl($value)
    {
        $this->_assetsUrl = $value;
    }


    /**
     * Setup yiiStrap, works even if YiiBooster is used in main app.
     */
    public function initYiiStrap()
    {
        // check that we are in a web application
        if (!(Yii::app() instanceof CWebApplication))
            return;
        // and in this module
        $route = explode('/', Yii::app()->urlManager->parseUrl(Yii::app()->request));
        if ($route[0] != $this->id)
            return;
        // and yiiStrap is not configured
        if (Yii::getPathOfAlias('bootstrap') && file_exists(Yii::getPathOfAlias('bootstrap.helpers') . '/TbHtml.php'))
            return;
        // try to guess yiiStrapPath
        if ($this->yiiStrapPath === null)
            $this->yiiStrapPath = Yii::getPathOfAlias('vendor.crisu83.yiistrap');
        // check for valid path
        if (!realpath($this->yiiStrapPath))
            return;
        // setup yiiStrap components
        Yii::setPathOfAlias('bootstrap', realpath($this->yiiStrapPath));
        Yii::import('bootstrap.helpers.*');
        Yii::import('bootstrap.widgets.*');
        Yii::import('bootstrap.behaviors.*');
        Yii::import('bootstrap.form.*');        
        Yii::app()->setComponents(array(
            'bootstrap' => array(
                'class' => 'bootstrap.components.TbApi',
            ),
        ), false);
    }

}
