<?php

namespace App\Http\Controllers\Api;

use App\Actions\User\CreateAction;
use App\Actions\User\LoginAction;
use App\Actions\User\LogoutAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    /**
     * Create user method
     *
     * @param CreateUserRequest $request
     * @param CreateAction $createAction
     * @return JsonResponse
     */
    public function create(CreateUserRequest $request, CreateAction $createAction): JsonResponse
    {
        return $createAction($request);
    }

    /**
     * Login user method
     *
     * @param Request $request
     * @param LoginAction $loginAction
     * @return JsonResponse
     */
    public function login(Request $request, LoginAction $loginAction): JsonResponse
    {
        return $loginAction($request);
    }

    /**
     * Logout user method
     *
     * @param LogoutAction $logoutAction
     * @return JsonResponse
     */
    public function logout(LogoutAction $logoutAction): JsonResponse
    {
        return $logoutAction();
    }
}
