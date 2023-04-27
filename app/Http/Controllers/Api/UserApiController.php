<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            "firstname"     => ["required", "string"],
            "lastname"      => ["required", "string"],
            "email"         => ["required", "string", "unique:users,email"],
            "phone"         => ["required", "regex:/((8|\+7)-?)?\(?\d{3,5}\)?-?\d{1}-?\d{1}-?\d{1}-?\d{1}-?\d{1}((-?\d{1})?-?\d{1})?/","string", "unique:users,phone"],
            "password"      => ["required", "string", "min:6", "confirmed"],
            "birthday"      => ["required", "date"],
            "photo"         => ["required", "image:jpg,jpeg,png"],
        ]);

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

    public function login(Request $request)
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

    public function logout()
    {
        Session::flush();

        Auth::logout();

        $json['success'] = 'User successfully logged out';

        return response()->json($json);
    }
}
