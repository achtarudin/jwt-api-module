<?php

return [
    'name'          => 'JwtApi',
    'auth_model'    => '\Modules\JwtApi\Entities\UserJwtModel',
    'driver'        => 'jwt',
    'provider'      => 'users',
    'guard'        => 'jwt_api',
];
