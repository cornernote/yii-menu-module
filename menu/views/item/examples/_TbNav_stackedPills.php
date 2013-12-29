<?php $this->widget('bootstrap.widgets.TbNav', array(
    'type' => TbHtml::NAV_TYPE_PILLS,
    'items' => $menuItem->getItems(),
    'stacked' => true,
)); ?>