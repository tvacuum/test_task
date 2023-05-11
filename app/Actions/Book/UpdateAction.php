<?php

namespace App\Actions\Book;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UpdateAction
{
    /**
     * Update book's info
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $result = Book::where('id', $request->id)->update($request->all());

        if ($result) {
            $json['success'] = "Book's data successfully updated";
        } else {
            $json['error'] = "Failed to update book's data";
        }
        return response()->json($json);
    }
}
