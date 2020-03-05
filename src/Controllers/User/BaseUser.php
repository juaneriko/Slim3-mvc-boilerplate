<?php
namespace App\Controllers\User;

use Slim\Http\Request;
use Slim\Http\Response;

class BaseUser
{
   protected $container;
   public function __construct($container){
       $this->container = $container;
   }

   public function jsonResponse(Response $response, string $status, $message, int $code)
   {
       $result = [
           'code' => $code,
           'status' => $status,
           'message' => $message,
       ];

       return $response->withJson($result, $code, JSON_PRETTY_PRINT);
   }
}
