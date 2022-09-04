<?php

namespace App\Repositories;

use App\Models\User;
use App\Http\Filters\UserFilter;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    public function model()
    {
        return User::class;
    }

    public function indexResource()
    {
        return $this->resource::collection($this->getModelData(app(UserFilter::class)));
    }
}
