<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CreateAction
{
    public function __invoke(Request $request): JsonResponse
    {
        session()->save();

        $data = $request->all();

        $photo_path = $request->file('photo')->store('users_photoes', 'public');

        $data['photo'] = $photo_path;

        if (User::create($data)) {
            $json['success'] = 'User successfully created';
        } else {
            $json['error'] = 'Failed to create user';
        }
        return response()->json($json);
    }
}
