<?php

/*
* As mentioned before, it's a good idea to seperate the applications
* for each environment. 
*/
$env = ENVIRONMENT;

$eveapp = [
    'development'   => [
        'callback'      => '',
        'clientID'      => '',
        'clientSecret'  => ''
    ],
    'production'    => [
        'callback'      => '',
        'clientID'      => '',
        'clientSecret'  => ''
    ]
];

$config['callback']     = $eveapp[$env]['callback'];
$config['clientID']     = $eveapp[$env]['clientID'];
$config['clientSecret'] = $eveapp[$env]['clientSecret'];