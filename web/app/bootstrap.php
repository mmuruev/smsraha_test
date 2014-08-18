<?php
/**
 *  File prepare Silex for work and set instance in App
 */
$loader = require_once __DIR__ . '/../../vendor/autoload.php';
/**
 *  Use include section
 */

/** Bootstraping */
$app = new Silex\Application();
$app['composer_loader'] = $loader;

$app['debug'] = file_exists(WEB_ROOT . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'mode' . DIRECTORY_SEPARATOR . 'debug');

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver' => 'pdo_mysql',
        'host' => 'localhost',
        'dbname' => 'smsraha',
        'username' => 'smsraha',
        'password' => 'smsraha',
    ),
));


$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => array(WEB_ROOT . DIRECTORY_SEPARATOR . 'view'),
    'twig.options' => array('cache' => WEB_ROOT . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'cache'),
));