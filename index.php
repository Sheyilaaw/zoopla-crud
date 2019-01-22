<?php
require_once  './routes.php';
//Composer Autoload
require_once './vendor/autoload.php';

function __autoload($className) {
    require_once "./app/core/{$className}.php";
}

$app = new App;