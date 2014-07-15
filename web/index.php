<?php

define('WEB_ROOT', __DIR__);
// Load  routes
require __DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'route.php';

$app->run();