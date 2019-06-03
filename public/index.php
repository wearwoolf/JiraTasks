<?php

use JiraTasks\Core\App;

chdir(dirname(__DIR__));
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', getcwd());
define('PUBLIC_PATH', ROOT_PATH . DS . 'public');
define('TEMPLATE_PATH', PUBLIC_PATH . DS . 'templates');
define('ASSETS_PATH', '/assets');

ini_set('auto_detect_line_endings', true);
date_default_timezone_set('UTC');

include __DIR__ . '/../vendor/autoload.php';

try {
    App::init()->bootstrap();
} catch (\Throwable $exception) {
    echo sprintf('Error: %s', $exception->getMessage());
    echo $exception->getCode();
    echo '<pre>';
    print_r($exception);
    echo '</pre>';
}
