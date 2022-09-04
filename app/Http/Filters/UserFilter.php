<?php

namespace App\Http\Filters;

use App\Http\Filters\Filter;

class UserFilter extends Filter
{

    public function email($value)
    {
        return $this->builder
            ->where('email', $value);
    }
}
