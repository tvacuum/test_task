<?php

namespace App\Actions\User;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutAction
{
    /**
     * Logout Authenticated user
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        Session::flush();

        Auth::logout();

        $json['success'] = 'User successfully logged out';

        return response()->json($json);
    }
}
