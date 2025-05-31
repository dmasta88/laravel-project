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
                $nameMethod = Str::camel($key);
                if (method_exists($this, $nameMethod)) {
                    $this->$nameMethod($builder, $data[$key]);
                }
            }
        }
        return $builder;
    }
}
