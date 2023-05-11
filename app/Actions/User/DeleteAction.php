<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteAction
{
    /**
     * Delete user by id
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $result = User::where('id', $request->id)->delete();

        if ($result) {
            $json['success'] = "User successfully deleted";
        } else {
            $json['error'] = "Failed to delete user";
        }
        return response()->json($json);
    }
}
