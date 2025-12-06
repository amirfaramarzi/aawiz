<?php

namespace App\V1\Middlewares;

use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Fomo\Auth\Auth;
use Fomo\Database\DB;
use Fomo\Request\Request;
use Fomo\Response\Status;

class AuthenticationMiddleware
{
    public function handle(Request $request): bool|string
    {
        try {
            $payload = JWT::decode($request->bearerToken(), new Key(config('app.jwt_key'), 'HS256'));
            Auth::getInstance()->setUser(DB::table('users')->where('id' , $payload->sub)->first());

            return true;
        } catch (ExpiredException){
            return $this->unAuthentication(true);
        } catch (Exception){
            return $this->unAuthentication(false);
        }
    }

    protected function unAuthentication(bool $expired): string
    {
        return response()->json([
            'message' => 'To use the features, log in first.' ,
            'expired_at' => $expired
        ] , Status::HTTP_UNAUTHORIZED->value);
    }
}