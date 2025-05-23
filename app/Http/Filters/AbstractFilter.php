<?php

namespace App\Http\Filters;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

abstract class AbstractFilter
{
    protected array $keys = [];
    public function apply(Builder $builder, array $data): Builder
    {
        foreach ($this->keys as $key) {
            if (isset($data[$key])) {
                $nameClass = Str::camel($key);
                $this->$nameClass($builder, $data[$key]);
            }
        }
        return $builder;
    }
}
