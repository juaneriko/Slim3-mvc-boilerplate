<?php declare(strict_types=1);



$container = $app->getContainer();
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use ($capsule){
   return $capsule;
};

$container['UserController'] = function ($container) {
    return new \App\Controllers\User\UserController($container);
 };



