<?php

namespace App\Http\Controllers;

use App\services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $token = null;

        if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
                'data' => '',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'message' => 'login success!',
            'data' => $token,
        ], 200);
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully',
                'data' => '',
            ], 200);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out',
                'data' => '',
            ], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|alpha_dash|max:191',
            'email' => 'required|email|unique:users|max:191',
            'password' => 'required|alpha_dash|max:191',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => true,
                'message' => $validator->errors()->first(),
                'data' => '',
            ], 401);
        }

        $this->userService->register($request);

        return response()->json([
            'success' => true,
            'message' => 'register success!',
            'data' => '',
        ], 200);
    }
}
