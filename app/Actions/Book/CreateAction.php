<?php

namespace App\Actions\Book;


use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CreateAction
{
    /**
     * Create book method
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $data = $request->all();

        $photo_path = $request->file('cover')->store('books_photos', 'public');

        $data['cover'] = $photo_path;

        $result = Book::create($data);

        if ($result) {
            $json['success'] = 'Book successfully created';
        } else {
            $json['error'] = 'Failed to create book';
        }
        return response()->json($json);
    }
}
