# Yii Menu Module

Provides components and an interface to manage menus using a database.

[![Mr PHP](https://raw.github.com/cornernote/mrphp-assets/master/img/code-banner.png)](http://mrphp.com.au) [![Project Stats](https://www.ohloh.net/p/yii-menu-module/widgets/project_thin_badge.gif)](https://www.ohloh.net/p/yii-menu-module) 

[![Latest Stable Version](https://poser.pugx.org/cornernote/yii-menu-module/v/stable.png)](https://packagist.org/packages/cornernote/yii-menu-module) [![Build Status](https://travis-ci.org/cornernote/yii-menu-module.png?branch=master)](https://travis-ci.org/cornernote/yii-menu-module)


### Contents

[Features](#features)  
[Screenshots](#screenshots)  
[Requirements](#requirements)  
[Installation](#installation)  
[Configuration](#configuration)  
[Usage](#usage)  
[License](#license)  
[Links](#links)  


## Features

- Simple to use interface.
- Unlimited menus, each with a hierarchy with unlimited depth.
- Supports drag and drop, and sortable.
- Right-click context menu allows full management from a single page.
- Inline usage examples for CHtml, CMenu and many YiiStrap widgets are provided.
- The examples show your actual menu.


## Screenshots

Menu Items List:
![items](https://raw.github.com/cornernote/yii-menu-module/master/screenshot/items.png)

Right-Click Context Menu:
![item-context](https://raw.github.com/cornernote/yii-menu-module/master/screenshot/item-context.png)

Create/Update Form:
![item-form](https://raw.github.com/cornernote/yii-menu-module/master/screenshot/item-form.png)

View Properties:
![item-properties](https://raw.github.com/cornernote/yii-menu-module/master/screenshot/item-properties.png)

View Examples:
![item-examples](https://raw.github.com/cornernote/yii-menu-module/master/screenshot/item-examples.png)


## Requirements

This is a Yii module, which requires the [Yii Framework](http://www.yiiframework.com).

In addition the following are required:
* [YiiStrap](http://www.getyiistrap.com) for the interface elements.  Please follow their Getting Started giude to setup the aliases and components for your application.


## Installation

Please download using ONE of the following methods:


### Composer Installation

```
curl http://getcomposer.org/installer | php
php composer.phar require cornernote/yii-menu-module
```


### Manual Installation

Download the [latest version](https://github.com/cornernote/yii-menu-module/archive/master.zip) and move the `menu` folder into your `protected/modules` folder.


## Configuration

Add yii-menu-module to the `modules` in your yii configuration:

```php
return array(
	'modules' => array(
		'menu' => array(
			// path to the MenuModule class
			'class' => 'vendor.cornernote.yii-menu-module.menu.MenuModule',
			// if you downloaded into modules
			//'class' => 'application.modules.menu.MenuModule',

			// add a list of users who can access the menu module
			'adminUsers' => array('admin'),

			// set this to false in production to improve performance
			'autoCreateTables' => true,
		),
	),
);
```


## Usage

To see how you can use your menus:

- Visit `index.php?r=menu`.
- Create a menu and some children.
- Right click your menu, click Properties, then click View Examples.


## License

- Author: Brett O'Donnell <cornernote@gmail.com>
- Author: Zain Ul abidin <zainengineer@gmail.com>
- Source Code: https://github.com/cornernote/yii-menu-module
- Copyright © 2013 Mr PHP <info@mrphp.com.au>
- License: BSD-3-Clause https://raw.github.com/cornernote/yii-menu-module/master/LICENSE


## Links

- [Yii Extension](http://www.yiiframework.com/extension/yii-menu-module)
- [Composer Package](https://packagist.org/packages/cornernote/yii-menu-module)
- [MrPHP](http://mrphp.com.au)

