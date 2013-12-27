<?php
/**
 * MenuAccessFilter
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-menu-module
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-menu-module/master/LICENSE
 *
 * @package yii-menu-module
 */
class MenuAccessFilter extends CFilter
{

    /**
     * @param CFilterChain $filterChain
     * @return bool
     * @throws CHttpException
     */
    protected function preFilter($filterChain)
    {
        $app = Yii::app();
        /** @var MenuModule $menu */
        $menu = $app->getModule('menu');
        if (!in_array($app->getUser()->getName(), $menu->adminUsers))
            throw new CHttpException(403, 'You are not allowed to access this page.');
        return parent::preFilter($filterChain);
    }

}
