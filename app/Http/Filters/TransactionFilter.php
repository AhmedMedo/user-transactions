<?php

namespace App\Http\Filters;

use App\Http\Filters\Filter;
use Carbon\Carbon;

class TransactionFilter extends Filter
{

    /**
     * Filter Transaction bu status
     */
    public function status($value)
    {
        $this->builder->whereIn('status' , explode(',',$value));
    }

    /**
     * Filter Transaction by currency
     */
    public function currency($value)
    {
        $this->builder->where('currency' , strtoupper($value));
    }

    /**
     * From Date
     */

    public function fromDate($value)
    {

        $this->builder->whereDate('payment_date', '>=' , Carbon::parse($value)->toDateString());
    }

    /**
     * to Date
     */

    public function toDate($value)
    {

        return $this->builder->whereDate('payment_date', '<=', Carbon::parse($value)->toDateString());
    }

    /**
     * Filter by user email
     */
    public function email($value)
    {
        return $this->builder->where('user_email', $value);
    }

    /**
     * Filter form payment amount
     */

    public function fromAmount($value)
    {
    $this->builder->where('paid_amount' , '>=' , $value);
    }

    /**
     * Filter to payment amount
     */

    public function toAmount($value)
    {
        $this->builder->where('paid_amount' , '<=' , $value);
    }
}
