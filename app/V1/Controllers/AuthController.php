<?php

namespace App\V1\Controllers;

use App\V1\Controllers\Controller;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Fomo\Database\DB;
use Fomo\Attributes\Method;
use Fomo\Attributes\Note;
use Fomo\Attributes\Route;
use Fomo\Request\Request;
use Fomo\Response\Status;

class AuthController extends Controller
{
    #[
        Route('v1/auth/register') ,
        Method('POST') ,
        Note('This service is for register.')
    ]
    public function register(Request $request): string
    {
        $validate = validation()->validate($request->post() , [
            'first_name' => 'required|string|max:64',
            'last_name' => 'string|max:64',
            'email' => 'required|string|email|unique:users,email|max:64',
            'password' => 'required|string|max:255',
        ]);
        if ($validate->hasError()){
            return $this->unprocessableResponse($validate->getErrors());
        }

        $userExist = DB::table('users')
            ->where('email',$request->post('email'))
            ->exists();

        if ($userExist){
            return $this->messageResponse('You have already registered, please log in to the program from the login section.' , Status::HTTP_BAD_REQUEST->value);
        }

        DB::table('users')->insert([
            'first_name' => $request->post('first_name') ,
            'last_name' => $request->post('last_name') ,
            'email' => $request->post('email') ,
            'password' => hash("sha256", $request->post('password')) ,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return $this->createdResponse("Your registration has been successful.\nPlease proceed to the login section.");
    }
    
    #[
        Route('v1/auth/login') ,
        Method('POST') ,
        Note('This service is for login.')
    ]
    public function login(Request $request): string
    {
        $validate = validation()->validate($request->post() , [
            'email' => 'required|string|email|max:64',
            'password' => 'required|string|max:255',
        ]);
        if ($validate->hasError()){
            return $this->unprocessableResponse($validate->getErrors());
        }

        $user = DB::table('users')
            ->where('email', $request->post('email'))
            ->first(['id', 'password']);
        if (!$user || $user->password != hash('sha256', $request->post("password"))){
            return $this->notFoundResponse('The password is incorrect or the username does not exist.');
        }

        $token = JWT::encode([
            'iss' => 'doko.ir' ,
            'aud' => 'seller' ,
            'iat' => time() ,
            'exp' => time() +  86400 ,
            'sub' => $user->id ,
        ] , config("app.jwt_key"), "HS256");

        return response()->json([
            'token' => $token ,
            'expired_at' => Carbon::now()->addSeconds(86400)->format("Y-m-d H:i:s")
        ]);
    }
}