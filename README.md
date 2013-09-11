# GameAnalytics for Laravel 4

[GameAnalytics](http://gameanalytics.com) is a powerful analytics engine for game studios that supports the full life
cycle from acquisition to retention to monetization of players - with a particular emphasis on user experience.
GameAnalytics has been built to specifically support the very data intensive games industry with tailor made reporting 
such as completion time per level, 3d heatmaps of in-game evens, and a pricing model that allows developers to track an
unlimited amount of in-game player behavior.

GameAnalytics for laravel 4 (ga-4-laravel) is a service provider for php laravel 4 framework. It is simple library/wrapper 
that provides you some useful methods to deal with Game Analytics REST API. 

---

- [Installation](#installation)
- [Registering the Package](#registering-the-package)
- [Configuration](#Configuration)
- [Usage](#usage)
- [More usage examples](#more-usage-examples)

## Installation

Add ga-4-laravel to your composer.json file:

```
"require": {
	"artdarek/ga-4-laravel": "dev-master"
}
```

Use [composer](http://getcomposer.org) to install this package.

```
$ composer update
```

### Registering the Package

Add the ga-4-laravel Service Provider to your config in ``app/config/app.php``:

```php
'providers' => array(
	'Artdarek\GameAnalytics\GameAnalyticsServiceProvider'
),
```

### Configuration

There are two ways to configure ga-4-laravel (GameAnalytics Service Provider for laravel 4). You can choose the most convenient way for you. 
You can put your GameAnalytics.com credentials into ``app/config/gameanalytics.php`` (option 1) file or use 
package config file which you can be generated through command line by artisan (option 2).

#### Option 1: Configure GameAnalytics Service Provider using ``app/config/gameanalytics.php`` file 

Create new config file in ``app/config/`` directory and name it ``gameanalytics.php``. Now simply edit created file and put there below code: 

```php

	/*
	|--------------------------------------------------------------------------
	| GameAnalytics Config
	|--------------------------------------------------------------------------
	*/
	'game' => array(

		/**
		 * Your Game Key
		 */
		'key' => '',

		/**
		 * Secret
		 */	
		'secret' => '', 

	),

	'api' => array(

		/**
		 * API version
		 */
		'version' => 1
	),

	/**
	 * Handler [Default: Curl]
	 */
	'handler' => 'Curl',

```

#### Option 2: Configure GameAnalytics Service Provider using package config file

Run on the command line from the root of your project:

```
$ php artisan config:publish artdarek/ga-4-laravel
```

Set your GameAnalytics credentials in ``app/config/packages/artdarek/ga-4-laravel/config.php``

## Usage

### Sending data to GameAnalytics

```php
	
	// data to send 
    $userData = [
	    "user_id" => "8f64a3b5-84c9-4932-9715-48e9456654b1",
	    "session_id" => "f81fc6bd-0d70-44f3-a3d2-9a3056d6d66f",
	    "build" => "Test",
	    "gender" => "M",
	    "birth_year" => 1977,
	    "friend_count" => 7
    ];

```

Send data to ``user`` category:

```php

	// send data to user category using query() method:
    $ga = GameAnalytics::query('user', $userData)->send();

	// send data to user category using queryUser() method:
    $ga = GameAnalytics::queryUser($userData)->send();

```

You can use these methods to send data to other categories: ``queryDesign()``, ``queryBusiness()``, ``queryQuality()`` or just pass name of the category (user, business, design, quality) as first parameter of ``query()`` method.

### More usage examples

Go to [Official docs](http://gameanalytics.zendesk.com/entries/22629512-Introduction) to find more usage examples and informations about GA REST API.
