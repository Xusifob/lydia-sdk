<?php

if(!file_exists(__DIR__ . '/vendor/autoload.php')){
    die('Did you install the dependencies running composer install ?');
}

$loader = require_once "../vendor/autoload.php";

// Load all the Acme Dummy classes
if($loader instanceof \Composer\Autoload\ClassLoader){
    $loader->add('Lydia', __DIR__ . '/src');
}

$credentials = new \Lydia\Entity\Credentials(array(
    'public_key' =>  'your_public_key',
    'private_key' =>  'your_private_key',
    'provider_token' =>  'your_provider_token',
    'provider_private_token' =>  'your_provider_private_token',
));


// Your environment. possible values : "dev" or "prod"
$env = 'dev';


// If the user is already logged in

// Get your user data from your DB
$data = array();

$user = new \Lydia\Entity\User($data);

$lydia = new \Lydia\Services\Lydia($credentials,$user,$env);