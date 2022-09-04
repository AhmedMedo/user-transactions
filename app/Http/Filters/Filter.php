<?php


namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

abstract class Filter
{
    /**
     * The request instance.
     *
     * @var Request
     */
    protected $request;

    /**
     * The builder instance.
     */
    protected $builder;

    protected $filterCriteria;

    /**
     * some data that gets loaded at some filters to be utilized by other filters
     *
     * @var array
     */
    protected $loadedData = [];

    /**
     * Initialize a new filter instance.
     *
     * @param  Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->filterCriteria=$this->request->all();
    }

    /**
     * Apply the filters on the builder.
     *
     * @param  Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder,$loggedInUser = null): Builder
    {
        $this->builder = $builder;

        foreach ($this->filterCriteria as $name => $value) {
            $name = Str::camel($name);

            $param =  array_filter(
                [$value], function ($value) {
                    return ($value !== null && $value !== false && $value !== '');
                }
            );

            if (method_exists($this, $name) && $param) {
                call_user_func_array(
                    [$this, $name],
                    [$param[0],$loggedInUser]
                );
            }
        }

        return $this->builder;
    }

    /**
     * Sort the model by the given order and field.
     *
     * @param  $value
     * @return Builder
     */
    public function sort( $value = [])
    {
        if(is_array($value)) {
            // Check if the current environment is tenant
            Schema::hasColumn($this->builder->getModel()->getTable(), $value['by'] ?? 'created_at');

            if (isset($value['by'])) {
                return $this->builder;
            }

            return $this->builder->orderBy(
                $this->builder->getModel()->getTable(). '.' .($value['by'] ?? 'created_at'), $value['order'] ?? 'desc'
            );
        }

        return $this->builder;
    }

    public function setFilterCriteria($filterCriteria)
    {
        $this->filterCriteria = $filterCriteria;
        return $this;
    }
}

