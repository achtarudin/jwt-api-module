<?php

namespace Modules\JwtApi\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JwtSettingMiddleware
{
    protected $model;
    protected $driver;
    protected $provider;
    protected $guard;

    public function __construct()
    {
        $this->model      = config('jwtapi.auth_model');
        $this->driver     = config('jwtapi.driver');
        $this->provider   = config('jwtapi.provider');
        $this->guard      = config('jwtapi.guard');
    }

    public function handle(Request $request, Closure $next)
    {
        // add content type to request
        $request->headers->set('Content-Type', 'application/json', true);

        config([
            'auth.providers.users.model'                => $this->model,
            "auth.guards.{$this->guard}.driver"         => $this->driver,
            "auth.guards.{$this->guard}.provider"       => $this->provider,
            'auth.defaults.guard'                       => $this->guard
        ]);

        // dd('JwtSettingMiddleware', config('auth'));

        return $next($request);
    }
}
