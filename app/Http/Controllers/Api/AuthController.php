<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseCodeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jiannei\Response\Laravel\Support\Facades\Response;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except('login');
    }

    public function login(AuthRequest $request)
    {
        $credentials = [
            'name' => $request->get('username'),
            'password' => $request->get('password'),
        ];

        if (!Auth::guard('admin')->attempt($credentials)) {
            abort(ResponseCodeEnum::SERVICE_LOGIN_ERROR);
        }

        $request->session()->regenerate();

        return Response::ok('', ResponseCodeEnum::SERVICE_LOGIN_SUCCESS);
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return Response::ok('', ResponseCodeEnum::SERVICE_LOGOUT_SUCCESS);
    }
}