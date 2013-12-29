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
     * @var string the ID of the {@link CDbConnection} application component. If not set,
     * a SQLite3 database will be automatically created and used. The SQLite database file
     * is <code>protected/runtime/menu-MenuVersion.db</code>.
     */
    public $connectionID;

    /**
     * @var boolean whether the DB tables should be created automatically if they do not exist. Defaults to true.
     * If you already have the table created, it is recommended you set this property to be false to improve performance.
     */
    public $autoCreateTables = true;

    /**
     * @var string
     */
    public $layout = 'column1';

    /**
     * @var array
     */
    public $controllerMap = array(
        'item' => 'menu.controllers.MenuItemController',
    );

    /**
     * @var array Use this to define access rules for the module.
     */
    public $controllerFilters = array(
        'menuAccess' => array('menu.components.MenuAccessFilter'),
    );

    /**
     * @var array Map of model info including relations and behaviors.
     */
    public $modelMap = array();

    /**
     * @var array
     */
    public $adminUsers = array();

    /**
     * @var array|string The view url for users, '--user_id--' will be replaced by the actual user_id.
     * <pre>
     * array('/user/view', 'id' => '--user_id--')
     * </pre>
     */
    public $userViewUrl;

    /**
     * @var CDbConnection the DB connection instance
     */
    private $_db;

    /**
     * @var string Url to the assets
     */
    private $_assetsUrl;

    /**
     * @return string
     */
    public static function powered()
    {
        return Yii::t('menu', 'Powered by {yii-menu-module}.', array('{yii-menu-module}' => '<a href="https://github.com/cornernote/yii-menu-module#yii-menu-module" rel="external">Yii Menu Module</a>'));
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
        Yii::setPathOfAlias('menu', dirname(__FILE__));
        $this->setImport(array(
            'menu.models.*',
            'menu.components.*',
        ));

        // map models
        foreach ($this->getDefaultModelMap() as $method => $data)
            foreach ($data as $name => $options)
                if (empty($this->modelMap[$method][$name]))
                    $this->modelMap[$method][$name] = $options;

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
     * Sets the DB connection used by the cache component.
     * @param CDbConnection $value the DB connection instance
     * @since 1.1.5
     */
    public function setDbConnection($value)
    {
        $this->_db = $value;
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

}
