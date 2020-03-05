<?php declare(strict_types=1);

//**Linux Env */
// require __DIR__ . '/../../vendor/autoload.php';

//**Windows Env */
require __DIR__ . '\..\..\vendor/autoload.php';


//**Environments Variable */
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/../../');
$dotenv->load();



$settings = require __DIR__ . '/settings.php';
$app = new \Slim\App($settings);

require __DIR__ . '/Dependencies.php';
require __DIR__ . '/Routes.php';
