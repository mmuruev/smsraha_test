<?php
define('INDEX_PAGE_TEMPLATE', 'index.html');
define('TEMPLATE_DIR', 'view');

require_once __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'security.php';


/**
 *  Main page template load controller
 */
$app->get('/', function (\Silex\Application $app) {
    $templatePath = WEB_ROOT . DIRECTORY_SEPARATOR . TEMPLATE_DIR . DIRECTORY_SEPARATOR . INDEX_PAGE_TEMPLATE;
    if (!file_exists($templatePath)) {
        $app->abort(404);
    }
    return $app->sendFile($templatePath);
})->bind('index');