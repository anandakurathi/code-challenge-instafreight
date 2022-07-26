<?php

require 'vendor/autoload.php';

$config = require_once './App/Config/app.php';

$quote = new \App\Controller\Quote();

$quoteResponse = [];

foreach ($config['providers'] as $provider) {
    $className = '\\App\\Services\\'.ucfirst($provider);
    $response = $quote->quote(new $className);
    $quoteResponse[$provider] = $response;
}

var_dump($quoteResponse);
