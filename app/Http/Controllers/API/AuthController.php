<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\AuthResponse;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\User\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends BaseController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function register(RegisterRequest $request)
    {
        try {
            $request->validated();
            $user = $this->userService->create($request);
            $token = $user->createToken('auth_token')->plainTextToken;
            return $this->sendSuccessAuth('Successfully Registered', 200, $token, new AuthResponse($user));
        } catch (Exception $err) {
            return $this->sendError('Fail', 422, $err->getMessage());
        }
    }

    public function index()
    {
        $data = User::all();
        return response()->json($data);
    }

    public function login(LoginRequest $request)
    {

        try {
            $request->validated();
            $user = $this->userService->verifyCredentials($request->email, $request->password);
            if ($user) {
                $token = $user->createToken('auth_token')->plainTextToken;
                return $this->sendSuccessAuth('Successfully Logged In', 200, $token, new AuthResponse($user));
            } else {
                return $this->sendError('Fail', 422, 'Invalid Credentials');
            }
        } catch (Exception $err) {
            return $this->sendError('Unauthorized', 404, $err->getMessage());
        }
    }
}
