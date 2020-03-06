<?php declare(strict_types=1);

 
    use Slim\Http\Request;
    use Slim\Http\Response;
   
    // use App\Controllers\User\UserController;

    $app->group('/api/v1', function () use ($app) {
        $app->group('/users', function () use ($app) {
            $app->get('', 'UserController:index');
            $app->post('/create','UserController:createUser');
            $app->get('/[{id}]','UserController:getUser');
            $app->post('/update/[{id}]','UserController:updateUser');
            $app->delete('/[{id}]','UserController:deleteUser');
            
        });
    });


    $app->get('/create',  UserController::class . ':index');
    $app->get('/', 'HomeController:index');
    $app->put('/update/[{id}]','UserController:updateUser' );


  
