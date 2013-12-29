<?php $this->widget('bootstrap.widgets.TbNav', array(
    'type' => TbHtml::NAV_TYPE_TABS,
    'items' => $menuItem->getItems(),
    'stacked' => true,
)); ?>