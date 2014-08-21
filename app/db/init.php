<?php
/**
 *  Up to one dir
 */
define('DIRECTORY_UP', '..');
/**
 *  Config dir name
 */
define('CONFIG_DIR_NAME', 'config');
/**
 *  Project root dir
 */
define('PROJECT_ROOT', realpath(__DIR__ . DIRECTORY_SEPARATOR . DIRECTORY_UP . DIRECTORY_SEPARATOR . DIRECTORY_UP));
/**
 *  Config dir full path
 */
define('GLOBAL_CONFIG_DIR', PROJECT_ROOT . DIRECTORY_SEPARATOR . CONFIG_DIR_NAME);
/**
 *  Mode dir
 */
define('MODE_DIR_NAME', 'mode');

/**
 * debug flag
 */
define('DEBUG_FLAG_FILE', 'debug');

/**
 *
 */
define('CONFIG_FILE_NAME', 'global_config.yml');

/**
 *  File prepare Silex for work and set instance in App
 */
$loader = require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

/** Bootstraping */
$app = new \Silex\Application();

$app['composer_loader'] = $loader;

$app['debug'] = file_exists(PROJECT_ROOT . DIRECTORY_SEPARATOR . MODE_DIR_NAME . DIRECTORY_SEPARATOR . DEBUG_FLAG_FILE);

$app->register(new Igorw\Silex\ConfigServiceProvider(GLOBAL_CONFIG_DIR.DIRECTORY_SEPARATOR. 'global_config.yml')); // main config
$app->register(new \Silex\Provider\DoctrineServiceProvider());


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

