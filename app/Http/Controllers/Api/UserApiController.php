<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserApiController extends Controller
{
    public function create(UserCreateRequest $request): JsonResponse
    {
        session()->save();

        $photo_path = $request->file('photo')->store('users_photoes', 'public');

        $new_user = User::create([
            'firstname' => $request['firstname'],
            'lastname'  => $request['lastname'],
            'email'     => $request['email'],
            'phone'     => $request['phone'],
            'password'  => bcrypt($request['password']),
            'birthday'  => $request['birthday'],
            'photo'     => $photo_path
        ]);

        if ($new_user) {
            $json['success'] = 'User successfully created';
        } else {
            $json['error'] = 'Failed to create user';
        }
        return response()->json($json);
    }

    public function login(Request $request): JsonResponse
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

    public function logout(): JsonResponse
    {
        Session::flush();

        Auth::logout();

        $json['success'] = 'User successfully logged out';

        return response()->json($json);
    }
}
