<?php

namespace Modules\JwtApi\Entities;

use App\Models\User;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserJwtModel extends User implements JWTSubject
{

    protected $table = 'users';

    protected $guarded = [];

    public $timestamps = false;

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
