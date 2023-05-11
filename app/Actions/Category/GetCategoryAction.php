<?php

namespace App\Actions\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GetCategoryAction
{
    /**
     * Gets category with books from that category
     *
     * @param Request $request
     * @return JsonResponse|null
     */
    public function __invoke(Request $request): JsonResponse | null
    {
        $category = Category::find($request->id);

        $category->books;

        return response()->json($category);
    }
}
