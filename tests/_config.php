<?php
/**
 * Global Test Config
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-menu-module
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-menu-module/master/LICENSE
 *
 * @package yii-menu-module
 */

return array(
    'basePath' => BASE_PATH,
    'runtimePath' => realpath(BASE_PATH . '/_runtime'),
    'import' => array(
        'menu.components.*',
        'menu.models.*',
        'bootstrap.helpers.TbHtml',
    ),
    'aliases' => array(
        'bootstrap' => realpath(BASE_PATH . '/../vendor/crisu83/yiistrap'),
        'menu' => realpath(BASE_PATH . '/../menu'),
        'vendor' => realpath(BASE_PATH . '/../vendor'),
    ),
    'controllerMap' => array(
        'site' => 'application._components.SiteController',
    ),
    'components' => array(
        'assetManager' => array(
            'basePath' => realpath(BASE_PATH . '/_public/assets'),
        ),
        'bootstrap' => array(
            'class' => 'bootstrap.components.TbApi',
        ),
        'db' => array(
            'connectionString' => 'sqlite:' . realpath(BASE_PATH . '/_runtime') . '/test.db',
            'enableProfiling' => true,
            'enableParamLogging' => true,
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
        ),
    ),
    'modules' => array(
        'menu' => array(
            'class' => 'menu.MenuModule',
            'connectionID' => 'db',
            'controllerFilters' => array(),
        ),
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'generatorPaths' => array(
                'vendor.cornernote.gii-modeldoc-generator',
                'bootstrap.gii',
            ),
            'ipFilters' => array('127.0.0.1'),
            'password' => false,
        ),
    ),
);