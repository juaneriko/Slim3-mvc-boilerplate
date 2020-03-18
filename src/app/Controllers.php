<?php declare(strict_types=1);

use App\Repository\UserRepository;

$container = $app->getContainer();

$container['user_repository'] = function ($container): UserRepository {
    return new UserRepository($container->get('db'));
};

$container['UserController'] = function ($container) {
    return new \App\Controllers\User\UserController($container);
 };

 $container['LoginController'] = function ($container) {
    return new \App\Controllers\User\LoginController($container);
 };

