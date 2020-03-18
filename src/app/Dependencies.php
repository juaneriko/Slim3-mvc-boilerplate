<?php declare(strict_types=1);

use Slim\Http\Request;
use Slim\Http\Response;

$container = $app->getContainer();
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use ($capsule){
   return $capsule;
};

$container['errorHandler'] = function ($container) {
   return function (Request $request, Response $response, \Exception $exception) use ($container) {
       //Format of exception to return
       $statusCode = 500;
        if (is_int($exception->getCode()) && $exception->getCode() >= 400 && $exception->getCode() <= 599) {
            $statusCode = $exception->getCode();
        }
        $className = new \ReflectionClass(get_class($exception));
        $data = [
            'message' => $exception->getMessage(),
            //'class' => $className->getShortName(),
            'status' => 'error',
            'code' => $statusCode,
        ];
        $body = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

        return $response
                ->withStatus($statusCode)
                ->withHeader('Content-type', 'application/problem+json')
                ->write($body);
   };
};