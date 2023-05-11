<?php

namespace App\Actions\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CreateAction
{
    /**
     * Create category method
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $result = Category::create($request->all());

        if ($result) {
            $json['success'] = 'Category successfully created';
        } else {
            $json['error'] = 'Failed to create category';
        }
        return response()->json($json);
    }
}
