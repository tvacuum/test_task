<?php

namespace App\Actions\User;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LoginAction
{
    /**
     * Authenticate by phone / email
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $result = auth("web")->attempt([
            is_numeric($request->login) ? 'phone' : 'email' => $request->login,
            'password' => $request->password
        ]);

        if ($result) {
            session()->regenerate();

            $json['success'] = 'You are successfully logged in';
        } else {
            $json['error'] = 'Failed to login';
        }
        return response()->json($json);
    }
}
