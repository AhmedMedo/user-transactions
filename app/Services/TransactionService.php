<?php

namespace App\Services;

use App\Repositories\TransactionRepository;
use App\Services\BaseService;

class TransactionService extends BaseService
{

    /**
     * The OrderRepository repository instance.
     *
     * @var TransactionRepository
     */
    protected $repository;
    public function __construct(TransactionRepository $repository)
    {
        parent::__construct($repository);
    }
}
