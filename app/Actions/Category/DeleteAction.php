<?php

namespace App\Actions\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DeleteAction
{
    /**
     * Delete category by id
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $result = Category::where('id', $request->id)->delete();

        if ($result) {
            $json['success'] = "Category successfully deleted";
        } else {
            $json['error'] = "Failed to delete Category";
        }
        return response()->json($json);
    }
}
