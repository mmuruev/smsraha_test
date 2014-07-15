<?php
/**
 *  File prepare Silex for work and set instance in App
 */
$loader = require_once __DIR__ . '/../../vendor/autoload.php';
/**
 *  Use include section
 */
use app\db\Constants;

/** Bootstraping */
$app = new Silex\Application();
$app['composer_loader'] = $loader;

$app['debug'] =  file_exists(WEB_ROOT . DIRECTORY_SEPARATOR . 'mode' . DIRECTORY_SEPARATOR . 'debug');