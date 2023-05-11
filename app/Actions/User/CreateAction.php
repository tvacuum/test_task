<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CreateAction
{
    /**
     * Create user method
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        session()->save();

        $data = $request->all();

        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        if ($user) {
            $json['success'] = 'User successfully created';
        } else {
            $json['error'] = 'Failed to create user';
        }
        return response()->json($json);
    }
}
