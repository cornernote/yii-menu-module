<?php
/**
 * MenuItemController
 *
 * @method MenuItem loadModel() loadModel($id, $model = null)
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-menu-module
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-menu-module/master/LICENSE
 *
 * @package yii-menu-module
 */
class MenuItemController extends MenuBehaviorActionWebController
{

    /**
     * @param string $view the view to be rendered
     * @return bool
     */
    public function beforeRender($view)
    {
        if ($view != 'index')
            $this->addBreadcrumb(Yii::t('menu', Yii::t('menu', 'Items')), Yii::app()->user->getState('index.menuItem', array('item/index')));

        return parent::beforeRender($view);
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return array(
            'jsTreeBehavior' => array(
                'class' => 'menu.behaviors.MenuJsTreeBehavior',
                'modelClassName' => 'MenuItem',
                'form_alias_path' => 'menu.views.item._form',
                'view_alias_path' => 'menu.views.item.view',
                'label_property' => 'label',
                'rel_property' => 'label',
            )
        );
    }

    /**
     * Index
     */
    public function actionIndex()
    {
        $this->render('index');
    }

    /**
     * Example
     * @param $id
     */
    public function actionExample($id)
    {
        $menuItem = $this->loadModel($id);

        $this->render('example', array(
            'menuItem' => $menuItem,
        ));
    }

    /**
     * @param $view
     * @param array $data
     * @param bool $return
     * @return string|null
     */
    public function renderExample($view, $data = array(), $return = false)
    {
        $output = CHtml::tag('div', array('class' => 'bs-docs-example'), $this->renderPartial($view, $data, true));
        $output .= CHtml::tag('pre', array('class' => 'prettyprint linenums'), CHtml::encode(file_get_contents($this->getViewFile($view))));
        if ($return)
            return $output;
        echo $output;
    }

}
