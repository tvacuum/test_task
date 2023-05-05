<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordAction
{
    public function __invoke(Request $request): JsonResponse
    {
        if (Hash::check($request->current_password, Auth::user()->getAuthPassword())) {
            if (strcmp($request->current_password, $request->password) != 0) {
                User::where(['id' => Auth::id()])
                    ->update([
                        'password' => bcrypt($request->password),
                    ]);
                $json['success'] = 'You successfully changed your password';
            } else {
                $json['error'] = 'New Password cannot be same as your current password';
            }
        } else {
            $json['error'] = 'Current password is incorrect';
        }
        return response()->json($json);
    }
}
