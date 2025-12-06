<?php

namespace App\V1\Middlewares;

use App\V1\Traits\Response\MessageTrait;
use Fomo\Database\DB;
use Fomo\Request\Request;

class AdminAccessMiddleware
{
    use MessageTrait;

    public function handle(Request $request): bool|string
    {
        $user = DB::table('users')
            ->where('id' , auth()->getId())
            ->first('level');

        if (!$user || $user->level != 'admin'){
            return $this->forbiddenResponse();
        }

        return true;
    }
}