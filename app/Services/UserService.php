<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\BaseService;

class UserService extends BaseService
{

    /**
     * The OrderRepository repository instance.
     *
     * @var UserRepository
     */
    protected $repository;
    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }
}
