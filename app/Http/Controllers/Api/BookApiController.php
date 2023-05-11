<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use Illuminate\Http\JsonResponse;
use App\Actions\Book\CreateAction;
use App\Actions\Book\DeleteAction;
use App\Actions\Book\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BookIdRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Requests\Book\CreateBookRequest;

class BookApiController extends Controller
{
    public function create(CreateBookRequest $request, CreateAction $createAction): JsonResponse
    {
        return $createAction($request);
    }

    public function getBook(BookIdRequest $request): Book | null
    {
        return Book::find($request->id);
    }

    public function getAllBooks(): Book | null
    {
        return Book::paginate(10);
    }

    public function update(UpdateBookRequest $request, UpdateAction $updateAction): JsonResponse
    {
        return $updateAction($request);
    }

    public function delete(BookIdRequest $request, DeleteAction $deleteAction): JsonResponse
    {
        return $deleteAction($request);
    }
}
