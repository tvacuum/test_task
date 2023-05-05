<?php

namespace App\Http\Controllers\Api;

use App\Actions\User\ChangePasswordAction;
use App\Actions\User\CreateAction;
use App\Actions\User\InfoEditAction;
use App\Actions\User\LoginAction;
use App\Actions\User\LogoutAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UserInfoEditRequest;
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
     * Logout Authenticated user method
     *
     * @param LogoutAction $logoutAction
     * @return JsonResponse
     */
    public function logout(LogoutAction $logoutAction): JsonResponse
    {
        return $logoutAction();
    }

    /**
     * Change password for Authenticated user
     *
     * @param ChangePasswordRequest $request
     * @param ChangePasswordAction $changePasswordAction
     * @return JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request, ChangePasswordAction $changePasswordAction): JsonResponse
    {
        return $changePasswordAction($request);
    }

    /**
     * Edit Authenticated user info
     *
     * @param UserInfoEditRequest $request
     * @param InfoEditAction $infoEditAction
     * @return null
     */
    public function userInfoEdit(UserInfoEditRequest $request, InfoEditAction $infoEditAction)
    {
        return $infoEditAction($request);
    }
}
