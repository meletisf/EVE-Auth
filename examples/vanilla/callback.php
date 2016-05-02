<?php


require('../Eveauth.php');

$app = new Eveauth([
	'callback'      => '',
    'clientID'      => '',
    'clientSecret'  => ''
]);

/*
* This where the callback url must be pointing to.
* Once the user selects his character, he will be redirected
* here with 'code' as a GET parameter.
*/
$code = $_GET['code'];

/*
* Pass the code as a parameter. Make sure the check wheter is
* set or not.
*/
$tokenData = $app->obtainAccessToken($code);

/*
* Pass $tokenData as a parameter in order to exchange the
* token for the actual character data.
*/
$characterData = $app->getCharacterID($tokenData);

/*
* You migth want to do something like this
*/
$this->User->authenticate($characterData);