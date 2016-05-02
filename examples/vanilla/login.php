<?php


require('../Eveauth.php');

$app = new Eveauth([
	'callback'      => '',
    'clientID'      => '',
    'clientSecret'  => ''
]);

header('Location: ' . $app->getEVELink());