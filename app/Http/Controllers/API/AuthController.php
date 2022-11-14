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


/**
 * @OA\Post(
 *  path="/api/register",
 *  summary="Register",
 *  tags={"Auth"},
 *  @OA\Parameter(
 *     name="access_token",
 *     in="query",
 *     description="Access Token",
 *     required=true,
 *  ),
 * @OA\Response(
 *  response=401,
 *  description="Unauthenticated",
 *  @OA\JsonContent(
 *     @OA\Property(property="message", type="string", example="Unauthenticated"),
 *     @OA\Property(property="status", type="integer", example="401"),
 *     @OA\Property(property="data", type="string", example="Unauthenticated"),
 *     @OA\Property(property="exception", type="string", example="Illuminate\\Auth\\AuthenticationException"),
 *  )
 * )
 * )
 */

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


/**
 * @OA\Post(
 * path="/api/login",
 * summary="Login",
 * description="Login by email and password",
 * operationId="login",
 * tags={"Auth"},
 * @OA\RequestBody(
 *  required=true,
 *  @OA\JsonContent(ref="#/components/schemas/LoginRequest")
 * ),
 * @OA\Response(
 *  response=200,
 *  description="Success",
 *  @OA\JsonContent(ref="#/components/schemas/AuthResponse"),
 *  @OA\Property(property="access_token", type="string", example="access_token")
 * ),
 * @OA\Response(
 *  response=401,
 *  description="Unauthenticated"
 * )
 *
 * )
 *
 */
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
