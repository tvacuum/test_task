<?php

namespace App\Actions\Book;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DeleteAction
{
    /**
     * Delete book by id
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $result = Book::where('id', $request->id)->delete();

        if ($result) {
            $json['success'] = "Book successfully deleted";
        } else {
            $json['error'] = "Failed to delete book";
        }
        return response()->json($json);
    }
}
