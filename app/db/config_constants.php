<?php
namespace app\db;
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
 *  Config file name
 */
define('CONFIG_FILE_NAME', 'global_config.yml');

/**
 *  Vendor dir name
 */
define('VENDOR_DIR_NAME', 'vendor');