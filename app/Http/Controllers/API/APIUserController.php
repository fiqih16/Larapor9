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

    /**
     * @OA\Post(
     *  path="/api/profile",
     *  summary="Profile",
     *  tags={"User"},
     *  @OA\Parameter(
     *    name="access_token",
     *    in="query",
     *    description="Access Token",
     *    required=true,
     *    @OA\Schema(
     *      type="string"
     *    )
     *  ),
     * @OA\Response(
     *  response=401,
     *  description="Unauthenticated",
     *  @OA\JsonContent(
     *      @OA\Property(property="message", type="string", example="Unauthenticated"),
     *      @OA\Property(property="status", type="integer", example="401"),
     *      @OA\Property(property="data", type="string", example="Unauthenticated"),
     *  )
     * )
     * )
     */
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