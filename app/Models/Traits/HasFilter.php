<?php

namespace App\Models\Traits;

//use App\Http\Filters\PostFilter;
use Illuminate\Database\Eloquent\Builder;

trait HasFilter
{
    public function scopeFilter(Builder $builder, $data)
    {
        $className = "App\Http\Filters\\" . class_basename($this) . 'Filter';
        if (class_exists($className)) {
            $filter = new $className();
            return $filter->apply($builder, $data);
        }
        return $builder;
    }
}
