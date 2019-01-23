<?php
session_start();

//Composer Autoload
require_once 'vendor/autoload.php';

require_once 'boot.php';

require_once 'routes.php';
require_once 'app/database.php';

$sessionProvider = new EasyCSRF\NativeSessionProvider();
$easyCSRF = new EasyCSRF\EasyCSRF($sessionProvider);

$app = new App;