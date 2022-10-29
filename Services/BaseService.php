<?php

namespace Modules\JwtApi\Services;

use Illuminate\Database\Eloquent\Model;

interface BaseService
{
    public function findByFilter(array $filter);
    public function findById($id) : ?Model;
    public function create(array $attributes): Model;
    public function update(Model $model, array $attributes): Model;
    public function delete(Model $model);
    public function saveDetail(Model $model, array $attributes): Model;
}
