<?php

use app\db;

require_once __DIR__ . DIRECTORY_SEPARATOR . '/../../app/db/config_constants.php';
/**
 *  File prepare Silex for work and set instance in App
 */
$loader = require_once __DIR__ . DIRECTORY_SEPARATOR . DIRECTORY_UP . DIRECTORY_SEPARATOR . DIRECTORY_UP . DIRECTORY_SEPARATOR .
    VENDOR_DIR_NAME . DIRECTORY_SEPARATOR . 'autoload.php';
/**
 *  Use include section
 */

/** Bootstraping */
$app = new Silex\Application();
$app['composer_loader'] = $loader;

$app['debug'] = file_exists(PROJECT_ROOT . DIRECTORY_SEPARATOR . MODE_DIR_NAME . DIRECTORY_SEPARATOR . DEBUG_FLAG_FILE);

$app->register(new \Igorw\Silex\ConfigServiceProvider(GLOBAL_CONFIG_DIR . DIRECTORY_SEPARATOR . CONFIG_FILE_NAME)); // main config

$app->register(new Silex\Provider\DoctrineServiceProvider());

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => array(WEB_ROOT . DIRECTORY_SEPARATOR . 'view'),
    'twig.options' => array('cache' => WEB_ROOT . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'cache'),
));