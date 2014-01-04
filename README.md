# Yii Menu Module

Provides components and an interface to manage menus using a database.


### Contents

- [Features](#features)
- [Screenshots](#screenshots)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Resources](#resources)
- [License](#license)


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


## Installation

Please download using ONE of the following methods:


### Composer Installation

All requirements are automatically downloaded into the correct location when using composer.  There is no need to download additional files or set paths to third party files.

Get composer:

```
curl http://getcomposer.org/installer | php
```

Install latest release OR development version:

```
php composer.phar require cornernote/yii-menu-module:*           // latest release
php composer.phar require cornernote/yii-menu-module:dev-master  // development version
```

Add the `vendor` folder to the `aliases` in your yii configuration:

```php
return array(
	'aliases' => array(
		'vendor' => '/path/to/vendor',
	),
);
```


### Manual Installation

Download the [latest version](https://github.com/cornernote/yii-menu-module/archive/master.zip) and move the `menu` folder into your `protected/modules` folder.

In addition the following are required:
* [YiiStrap](http://www.getyiistrap.com) for the interface elements.  Please follow their Getting Started giude to setup the aliases and components for your application.


## Configuration

Add yii-menu-module to the `modules` in your yii configuration:

```php
return array(
	'modules' => array(
		'menu' => array(
			// path to the MenuModule class
			'class' => '/path/to/vendor/cornernote/yii-menu-module/menu/MenuModule',

			// add a list of users who can access the menu module
			'adminUsers' => array('admin'),

			// set this to false in production to improve performance
			'autoCreateTables' => true,

			// this is only required if you do not want YiiStrap in your app config
			// for example, if you are running YiiBooster
			'yiiStrapPath' => '/path/to/yiistrap',
		),
	),
);
```


## Usage

To see how you can use your menus:

- Visit `index.php?r=menu`.
- Create a menu and some children.
- Right click your menu, click Properties, then click View Examples.


## Resources

[![Mr PHP](https://raw.github.com/cornernote/mrphp-assets/master/img/code-banner.png)](http://mrphp.com.au) [![Github Project](https://raw.github.com/cornernote/mrphp-assets/master/vendor/github/github-latest-sourcecode-16.png)](https://github.com/cornernote/yii-menu-module#yii-menu-module) [![Yii Extension](https://raw.github.com/cornernote/mrphp-assets/master/vendor/yii/yii-extension-16.png)](http://www.yiiframework.com/extension/yii-menu-module) [![Project Stats](https://www.ohloh.net/p/yii-menu-module/widgets/project_thin_badge.gif)](https://www.ohloh.net/p/yii-menu-module)

[![Latest Stable Version](https://poser.pugx.org/cornernote/yii-menu-module/v/stable.png)](https://packagist.org/packages/cornernote/yii-menu-module) [![Build Status](https://travis-ci.org/cornernote/yii-menu-module.png?branch=master)](https://travis-ci.org/cornernote/yii-menu-module) [![Dependencies Check](https://depending.in/cornernote/yii-menu-module.png)](https://depending.in/cornernote/yii-menu-module)

- [YiiStrap](http://getyiistrap.com/)
- [JSTreeBehavior](https://github.com/drumaddict/yii-jstree-behavior)
- [NestedSetBehavior](https://github.com/yiiext/nested-set-behavior)


## License

[BSD-3-Clause](https://raw.github.com/cornernote/yii-menu-module/master/LICENSE), Copyright © 2013-2014 [Mr PHP](mailto:info@mrphp.com.au)