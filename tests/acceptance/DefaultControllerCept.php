<?php
/**
 * DefaultController Test
 *
 * @var $scenario \Codeception\Scenario
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-email-module
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-email-module/master/LICENSE
 *
 * @package yii-email-module
 */

$I = new WebGuy($scenario);
$I->wantTo('ensure DefaultController works');

$I->amOnPage('email');
$I->see('You may use the following tools');

$I->click('Error');
$I->see('Errors');

$I->click('Field');
$I->see('Fields');

$I->click('Log');
$I->see('Logs');

$I->click('Request');
$I->see('Requests');

$I->click('Email');
$I->see('You may use the following tools');
