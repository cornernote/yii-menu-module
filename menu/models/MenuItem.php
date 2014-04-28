<?php
Yii::import('menu.components.MenuActiveRecord');

/**
 * MenuItem
 *
 * --- BEGIN ModelDoc ---
 *
 * Table menu_item
 * @property integer $id
 * @property integer $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
 * @property string $label
 * @property string $icon
 * @property string $url
 * @property string $url_params
 * @property string $target
 * @property string $access_role
 * @property integer $enabled
 * @property integer $created
 *
 * @see CActiveRecord
 * @method MenuItem find() find($condition = '', array $params = array())
 * @method MenuItem findByPk() findByPk($pk, $condition = '', array $params = array())
 * @method MenuItem findByAttributes() findByAttributes(array $attributes, $condition = '', array $params = array())
 * @method MenuItem findBySql() findBySql($sql, array $params = array())
 * @method MenuItem[] findAll() findAll($condition = '', array $params = array())
 * @method MenuItem[] findAllByPk() findAllByPk($pk, $condition = '', array $params = array())
 * @method MenuItem[] findAllByAttributes() findAllByAttributes(array $attributes, $condition = '', array $params = array())
 * @method MenuItem[] findAllBySql() findAllBySql($sql, array $params = array())
 * @method MenuItem with() with()
 *
 * @mixin MenuNestedSetBehavior
 *
 * --- END ModelDoc ---
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-menu-module
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-menu-module/master/LICENSE
 *
 * @package yii-menu-module
 */
class MenuItem extends MenuActiveRecord
{

    /**
     * @param string $className
     * @return MenuItem
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        $rules = array();
        if (in_array($this->scenario, array('insert', 'create', 'update'))) {
            $rules[] = array('label', 'required');
            $rules[] = array('enabled', 'numerical', 'integerOnly' => true);
            $rules[] = array('label, icon, url, url_params, target, access_role', 'length', 'max' => 255);
        }
        return $rules;
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('menu', 'ID'),
            'label' => Yii::t('menu', 'Label'),
            'icon' => Yii::t('menu', 'Icon'),
            'url' => Yii::t('menu', 'Url'),
            'url_params' => Yii::t('menu', 'Url Params'),
            'target' => Yii::t('menu', 'Target'),
            'access_role' => Yii::t('menu', 'Access Role'),
            'created' => Yii::t('menu', 'Created'),
            'deleted' => Yii::t('menu', 'Deleted'),
            'enabled' => Yii::t('menu', 'Enabled'),
        );
    }

    /**
     * $this->widget('zii.widgets.CMenu', array('items' => $menuItem->getItems()));
     *
     * @param int $depthLimit
     * @param array $options
     * @param int $depth
     * @return array
     */
    public function getItems($depthLimit = 0, $options = array(), $depth = 1)
    {
        $items = array();
        if ($depthLimit && $depthLimit < $depth)
            return $items;
        foreach ($this->children()->findAll('enabled=1') as $menuItem) {
            if (!$menuItem->checkAccess())
                continue;
            $items[] = $menuItem->getItem($depthLimit, $options, $depth);
        }
        return $items;
    }

    /**
     * @param int $depthLimit
     * @param array $options
     * @param int $depth
     * @return array|string
     */
    public function getItem($depthLimit = 0, $options = array(), $depth = 0)
    {
        $itemOptions = isset($options['itemOptions']) ? $options['itemOptions'] : array();
        $linkOptions = isset($options['linkOptions']) ? $options['linkOptions'] : array();
        if ($this->target)
            $linkOptions['target'] = $this->target;

        $submenuOptions = isset($options['submenuOptions']) ? $options['submenuOptions'] : array();
        if (isset($options['submenuOptions']))
            unset($options['submenuOptions']);

        $childItems = $this->getItems($depthLimit, $options, $depth + 1);
        if ($this->label == '---') {
            $item = TbHtml::menuDivider($itemOptions);
        }
        else {
            $item = array();
            $item['label'] = $this->label;
            if ($this->url) {
                $item['url'] = $this->getMenuUrl();
            }
            if ($this->icon) {
                $item['icon'] = $this->icon;
            }
            if ($itemOptions) {
                $item['itemOptions'] = $itemOptions;
            }
            if ($linkOptions) {
                $item['linkOptions'] = $linkOptions;
            }
            if ($submenuOptions) {
                $item['submenuOptions'] = $submenuOptions;
            }
            if ($childItems) {
                $item['items'] = $childItems;
            }
        }
        return $item;
    }

    /**
     * @return bool
     */
    public function checkAccess()
    {
        if (!$this->access_role || $this->access_role == '*')
            return true;
        /** @var CWebUser $user */
        $user = Yii::app()->user;
        if ($this->access_role == '?')
            return $user->isGuest;
        if ($this->access_role == '@')
            return !$user->isGuest;
        if ($user->checkAccess($this->access_role))
            return true;
        return false;
    }

    /**
     * @return array|string
     */
    protected function getMenuUrl()
    {
        if (strpos($this->url, 'http://') === 0) {
            return $this->url;
        }
        if (strpos($this->url, 'https://') === 0) {
            return $this->url;
        }
        if (strpos($this->url, 'javascript:') === 0) {
            return $this->url;
        }
        $urlParams = array($this->url);
        $params = explode('&', $this->url_params);
        foreach ($params as $param) {
            $param = explode('=', $param);
            if (isset($param[1])) {
                if ($param[1] == '{returnUrl}') {
                    $param[1] = Yii::app()->returnUrl->getLinkValue(true);
                }
                $urlParams[$param[0]] = $param[1];
            }
        }
        return $urlParams;
    }

    /**
     * @return string
     */
    public function getEnabledIcon()
    {
        return CHtml::tag('i', array('class' => 'fa fa-' . ($this->enabled ? 'check' : 'times')));
    }

    /**
     *
     */
    public function afterSave()
    {
        parent::afterSave();
        /** @var MenuModule $menu */
        $menu = Yii::app()->getModule('menu');
        if ($menu->getCache()) {
            $menu->getCache()->flush();
        }
    }

}