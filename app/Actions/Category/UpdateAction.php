<?php

namespace App\Actions\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UpdateAction
{
    /**
     * Update category's info
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $result = Category::where('id', $request->id)->update($request->all());

        if ($result) {
            $json['success'] = "Category's data successfully updated";
        } else {
            $json['error'] = "Failed to update category's data";
        }
        return response()->json($json);
    }
}
