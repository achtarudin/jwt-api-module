<?php

namespace Modules\JwtApi\Services\Auth;

use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\JwtApi\Services\BaseAuth;
use Illuminate\Database\Eloquent\Model;
use Modules\JwtApi\Entities\UserJwtModel;
use Modules\JwtApi\Exceptions\JwtApiException;

class AuthService implements BaseAuth
{
    protected $model;

    public function __construct(UserJwtModel $model)
    {
        $this->model = $model;
    }

    public function login(array $attributes): array
    {
        $token = auth()->attempt($attributes);

        throw_if($token == false, new JwtApiException('User Not Found', 404));

        return $this->generateToken($token);
    }

    public function registration(array $attributes): Model
    {
        DB::beginTransaction();
        try {
            $newUser = $this->model->create([
                'name'        => $attributes['name'],
                'email'       => $attributes['email'],
                'password'    => Hash::make($attributes['password']),
                'created_at'  => Carbon::now(),
            ]);
            DB::commit();
            return $this->model->whereId($newUser->id)->select('id', 'name', 'email')->first();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function user(): Model
    {
        $userId = auth()->user()->id;
        return $this->model->whereId($userId)->select('id', 'name', 'email')->first();
    }

    public function refresh(): array
    {
       return $this->generateToken();
    }

    public function logout(): void
    {
        auth()->logout();
    }

    protected function generateToken($token = null): array
    {
        return [
            'token'         => $token ? $token : auth()->refresh(),
            'type'          => 'Bearer',
            'expires_in'    => auth()->factory()->getTTL() * 60
        ];
    }
}
