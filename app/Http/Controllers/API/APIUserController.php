<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Services\User\UserService;
use App\Http\Requests\User\UserProfileRequest;


class APIUserController extends BaseController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function uploadAvatar(UserProfileRequest $request)
    {
        $validate = $request->validated();

        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'img/profile', $name);
            $validate['avatar'] = $name;
        }

        $validate['id'] = $request->user()->id;
        $user = $this->userService->saveAvatar($validate);
        return $this->sendSuccess('Successfully Uploaded', 200, $user);


    }
}