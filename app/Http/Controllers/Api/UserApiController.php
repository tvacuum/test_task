<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Actions\User\LoginAction;
use App\Actions\User\CreateAction;
use App\Actions\User\LogoutAction;
use App\Actions\User\DeleteAction;
use App\Actions\User\InfoEditAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserIdRequest;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UserInfoEditRequest;

class UserApiController extends Controller
{
    public function create(CreateUserRequest $request, CreateAction $createAction): JsonResponse
    {
        return $createAction($request);
    }

    public function login(Request $request, LoginAction $loginAction): JsonResponse
    {
        return $loginAction($request);
    }

    public function logout(LogoutAction $logoutAction): JsonResponse
    {
        return $logoutAction();
    }

    public function userInfoEdit(UserInfoEditRequest $request, InfoEditAction $infoEditAction): JsonResponse
    {
        return $infoEditAction($request);
    }

    public function deleteUser(UserIdRequest $request, DeleteAction $deleteAction): JsonResponse
    {
        return $deleteAction($request);
    }
    public function getUser(UserIdRequest $request): User | null
    {
        return User::find($request->id);
    }

    public function getAllUsers(): Collection | null
    {
        return User::all();
    }

    public function getAllReaders(): Collection | null
    {
        return User::where('is_worker', '!= 1')->get();
    }

    public function getAllWorkers(): Collection | null
    {
        return User::where('is_worker', '= 1')->get();
    }
}
