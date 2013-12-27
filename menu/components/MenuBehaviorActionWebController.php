<?php
/**
 * MenuBehaviorActionWebController.php
 *
 * Allows controllers that extend from it to inherit actions from behaviors
 * Idea by Yii user Mimin and  Kevin Higgins
 * @link http://www.yiiframework.com/forum/index.php/user/9488-mimin/
 * @link http://www.yiiframework.com/forum/index.php/user/24587-kevin-higgins/
 * Relevant discussion in Yii Forum
 * @link http://www.yiiframework.com/forum/index.php/topic/10652-actions-by-behavioring/
 */
class MenuBehaviorActionWebController extends MenuWebController
{

    /**
     * @var array
     */
    private $_behaviorIDs = array();


    /**
     * @param string $actionID
     * @throws CException
     * @return CAction|CInlineAction
     */
    public function createAction($actionID)
    {
        $action = parent::createAction($actionID);
        if ($action !== null)
            return $action;
        foreach ($this->_behaviorIDs as $behaviorID) {
            $object = $this->asa($behaviorID);
            if ($object->getEnabled() && method_exists($object, 'action' . $actionID))
                return new CInlineAction($object, $actionID);
        }
    }

    /**
     * @param string $name
     * @param mixed $behavior
     * @return \IBehavior|void
     */
    public function attachBehavior($name, $behavior)
    {
        $this->_behaviorIDs[] = $name;
        parent::attachBehavior($name, $behavior);
    }


}