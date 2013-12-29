<?php
$links = array();
foreach (MenuItem::model()->findByPk($id)->getItems() as $item) {
    $url = isset($item['url']) ? $item['url'] : null;
    $links[] = CHtml::link($item['label'], $url, array('class' => 'btn btn-default'));
}
echo implode(' ', $links);