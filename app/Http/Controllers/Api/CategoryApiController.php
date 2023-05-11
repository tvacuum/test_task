<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Actions\Category\CreateAction;
use App\Actions\Category\DeleteAction;
use App\Actions\Category\UpdateAction;
use App\Actions\Category\GetCategoryAction;
use App\Http\Requests\Category\CategoryIdRequest;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;

class CategoryApiController extends Controller
{
    public function create(CreateCategoryRequest $request, CreateAction $createAction): JsonResponse
    {
        return $createAction($request);
    }

    public function update(UpdateCategoryRequest $request, UpdateAction $updateAction): JsonResponse
    {
        return $updateAction($request);
    }

    public function getCategory(CategoryIdRequest $request, GetCategoryAction $getCategoryAction): JsonResponse | null
    {
        return $getCategoryAction($request);
    }

    public function delete(CategoryIdRequest $request, DeleteAction $deleteAction): JsonResponse
    {
        return $deleteAction($request);
    }
}
