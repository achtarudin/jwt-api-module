<?php

namespace Modules\JwtApi\Http\Controllers\Auth;

use Illuminate\Routing\Controller;
use Modules\JwtApi\Services\BaseAuth;
use Modules\JwtApi\Services\HttpResponseJson;
use Modules\JwtApi\Http\Requests\Auth\LoginRequest;
use Modules\JwtApi\Http\Requests\Auth\RegistrationRequest;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(BaseAuth $authService)
    {
        $this->authService = $authService;
    }

    public function postLogin(LoginRequest $request)
    {
        $valid = $request->validated();

        $result =  $this->authService->login($valid);

        return HttpResponseJson::success($result, 'User login successfully');

    }

    public function postRegistration(RegistrationRequest $request)
    {
        $valid = $request->validated();

        $result =  $this->authService->registration($valid);

        return HttpResponseJson::success(['user' => $result], 'User created successfully');
    }

    public function logout()
    {
        $this->authService->logout();

        return HttpResponseJson::success(null, 'Successfully logged out');
    }

    public function user()
    {
        $result =  $this->authService->user();

        return HttpResponseJson::success(['user' => $result], 'User data');
    }

    public function setting()
    {
        return HttpResponseJson::success(['setting' => config('auth')], 'Jwt Setting');
    }

    public function refresh()
    {
        $result =  $this->authService->refresh();

        return HttpResponseJson::success($result, 'refresh token');
    }

}
