<?php

namespace App\Actions\User;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class InfoEditAction
{
    /**
     * Update user's info
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $result = User::where('id', $request->id)->update($request->all());

        if ($result) {
            $json['success'] = "User's data successfully updated";
        } else {
            $json['error'] = "Failed to update user's data";
        }
        return response()->json($json);
    }
}
