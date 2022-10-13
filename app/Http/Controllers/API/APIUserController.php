<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\User\AboutUserRequest;
use App\Models\User;
use App\Services\User\UserService;
use App\Http\Requests\User\UserProfileRequest;
use Exception;
use App\Http\Resources\ProfileUserResponse;



class APIUserController extends BaseController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function uploadAvatar(UserProfileRequest $request)
    {
        try {
            $request->validated();
            $user = $this->userService->saveAvatar($request);
            return $this->sendResponse('Successfully Uploaded Avatar', 200, new ProfileUserResponse($user));
        } catch (Exception $err) {
            return $this->sendError('Fail', 422, $err->getMessage());
        }
    }

    public function aboutUser(AboutUserRequest $request)
    {
        try {
            $request->validated();
            $user = $this->userService->aboutUser($request);
            return $this->sendResponse('Successfully Updated Profile', 200, $user);
        } catch (Exception $err) {
            return $this->sendError('Fail', 422, $err->getMessage());
        }
    }
}