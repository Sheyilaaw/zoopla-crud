<?php
require_once  './routes.php';

function __autoload($className) {
    require_once "./app/core/{$className}.php";
}

$app = new App;