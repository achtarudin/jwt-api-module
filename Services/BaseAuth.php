<?php

namespace Modules\JwtApi\Services;

use Illuminate\Database\Eloquent\Model;

interface BaseAuth
{
    public function login(array $attributes): array;
    public function registration(array $attributes): Model;
    public function user(): Model;
    public function refresh(): array;
    public function logout(): void;

}
