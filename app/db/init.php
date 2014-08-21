<?php
namespace app\db;

use Igorw\Silex\ConfigServiceProvider;
use Silex\Provider\DoctrineServiceProvider;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'config_constants.php';
/**
 *  File prepare Silex for work and set instance in App
 */
$loader = require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . VENDOR_DIR_NAME.DIRECTORY_SEPARATOR.'autoload.php';

/** Bootstraping */
$app = new \Silex\Application();

$app['composer_loader'] = $loader;

$app['debug'] = file_exists(PROJECT_ROOT . DIRECTORY_SEPARATOR . MODE_DIR_NAME . DIRECTORY_SEPARATOR . DEBUG_FLAG_FILE);

$app->register(new ConfigServiceProvider(GLOBAL_CONFIG_DIR . DIRECTORY_SEPARATOR . CONFIG_FILE_NAME)); // main config
$app->register(new DoctrineServiceProvider());


$app['schema'] = $app->share(function () use ($app) {
    return new \app\db\migration\Schema($app['db']);
});

init($app);
/**
 * Run init for all Schema
 * @param \Silex\Application $app
 */
function init(\Silex\Application $app)
{
    echo 'Initialization';
    echo '>';
    try {
        \app\db\account\Schema::init($app);
        /** @noinspection PhpUndefinedMethodInspection */
        $app['schema']->apply();

    } catch (\Exception $exception) {
        $error = ' fail. Reason: ' . $exception->getMessage();
        echo $error . PHP_EOL;
        exit(1);
    }
    echo 'DONE' . PHP_EOL;
}

