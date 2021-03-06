<?php
namespace App\Controllers\User;

use App\Models\User;
use Slim\Http\Request;
use Slim\Http\Response;

class UserController extends BaseUser
{
   public function index(Request $request, Response $response, array $args)
   {
            $users = User::all();
            return $this->jsonResponse($response, 'success', $users, 201);

   }

   public function createUser(Request $request, Response $response, array $args)
   {
            $data = $request->getParsedBody();
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = $data['password'];

            $user->save();

            return $this->jsonResponse($response, 'success', $user, 201);
   }

   public function getUser(Request $request, Response $response, array $args)
   {
         $input = $request->getParsedBody();
         $userId = (int) $args['id'];

         $user = User::find($userId);

         return $this->jsonResponse($response, 'success', $user, 201);

   }

   public function updateUser(Request $request, Response $response, array $args)
   {
          
            $id = (int) $args['id'];
            $data = $request->getParsedBody();
            
            $user = User::find($id);
            $user->name = $data['name'] ?: $user->name;
            $user->email = $data['email'] ?: $user->email;
            $user->password = $data['password'] ?: $user->password;
      
            $user->save();

            return $this->jsonResponse($response, 'success', $user, 201);

   }

   public function deleteUser(Request $request, Response $response, array $args)
   {
          
            $id = (int) $args['id'];
          
            $user = User::find($id);
            $user->delete();
           
            return $this->jsonResponse($response, 'success', $user, 201);

   }

}
