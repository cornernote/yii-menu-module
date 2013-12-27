<?php
/**
 * @var $this MenuWebController
 * @var $content string
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-menu-module
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-menu-module/master/LICENSE
 *
 * @package yii-menu-module
 */
$this->beginContent('menu.views.layouts.main');
?>
    <div class="container">
        <?php
        if ($this->pageHeading || $this->menu) {
            if ($this->menu)
                $this->pageHeading .= $this->widget('zii.widgets.CMenu', array(
                    'items' => $this->menu,
                    'htmlOptions' => array('class' => 'inline pull-right'),
                ), true);
            echo CHtml::tag('h1', array(), $this->pageHeading);
        }
        ?>
        <div id="content">
            <?php
            echo $content;
            ?>
        </div>
    </div>
<?php
$this->endContent();