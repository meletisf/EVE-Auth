# Class configuration

Download `Eveauth.php` place it where ever you think is appropriate and then `require()` it. 

Once you do that you can initialize the class by inserting an array as its first argument.

```php

$EVEApplication = [
	'callback'      => 'your callback url',
	'clientID'      => 'your client ID',
	'clientSecret'  => 'your client secret'
];

$eveapp = new Eveauth($EVEApplication);

```

The keys **callback**, **clientID** and **clientSecret** MUST be kept the same.

-----

**Next: [Server requirements](/documentation/requirements.md)**
