<?php

namespace App\Actions\User;


use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InfoEditAction
{
    public function __invoke(Request $request): void
    {
        $result = User::where([
            'id' => Auth::id()
        ])->update($request->all());

        if ($result) {
            $json['success'] = "User's data successfully updated";
        } else {
            $json['error'] = "Failed to update user's data";
        }
    }
}
