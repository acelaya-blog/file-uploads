<?php
require __DIR__ . '/../vendor/autoload.php';
chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

// Define file upload properties
ini_set('post_max_size', '1536M');
ini_set('upload_max_filesize', '1536M');
ini_set('memory_limit', '1536M');

// Run the application!
$app = Zend\Mvc\Application::init([
    'modules' => [
        'Acelaya'
    ],
    'module_listener_options' => []
]);
$app->run();
