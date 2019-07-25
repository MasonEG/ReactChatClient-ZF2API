<?php

chdir(dirname(__DIR__));

$loader = require 'vendor/autoload.php';

define('APPLICATION_ENV', getenv('APPLICATION_ENV') ?: Webdev\EnvironmentDetector::detect());
define('UPLOAD_PATH', 'data/uploads');

$app = Webdev\Mvc\Application::init(include 'config/application.config.php')->run();
