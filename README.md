Game Analytics for Laravel 4

Full docs will be created soon... 

Usage example:

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
