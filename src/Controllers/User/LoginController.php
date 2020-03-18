<?php
namespace App\Controllers\User;

use App\Models\User;
use Slim\Http\Request;
use Slim\Http\Response;
use \Firebase\JWT\JWT;

class LoginController extends BaseUser
{
   public function index(Request $request, Response $response, array $args)
   {
    $data = $request->getParsedBody();
    $jwt = $this->login($data);

    $message = [
        'Authorization' => 'Bearer ' . $jwt,
    ];

    return $this->jsonResponse($response, 'success', $message, 200);

   }

   public function login(?array $input){

    $data = json_decode(json_encode($input), false);
    

    //** Input Validation */
    if (!$data->email) {
        throw new \ErrorException('The field "email" is required.', 400);
    }
    if (!$data->password) {
        throw new \ErrorException('The field "password" is required.', 400);
    }

    $password = hash('sha512', $data->password);
    $user = $this->loginUser($data->email, $password);
    
    //**Create jason web token */
    $token = array(
        'sub' => $user->id,
        'email' => $user->email,
        'name' => $user->name,
        'iat' => time(),
        'exp' => time() + (7 * 24 * 60 * 60),
    );

    return JWT::encode($token, getenv('SECRET_KEY'));

   }

   public function loginUser(string $email, string $password){
    
    $user = User::where('email', $email)->where('password', $password)->first();
    
    if (empty($user)) {
        throw new \ErrorException('Login failed: Email or password incorrect.', 400);
    }
    return $user;

   }
}
