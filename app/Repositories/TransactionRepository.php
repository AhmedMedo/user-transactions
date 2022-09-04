<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Repositories\BaseRepository;
use App\Http\Filters\TransactionFilter;

class TransactionRepository extends BaseRepository
{
    public function model()
    {
        return Transaction::class;
    }

    public function indexResource()
    {
        return $this->resource::collection($this->getModelData(app(TransactionFilter::class)));
    }
}
