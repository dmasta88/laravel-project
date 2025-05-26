<?php

namespace App\Http\Filters;

class CategoryFilter extends AbstractFilter
{
    protected array $keys = [
        'title',
    ];

    protected function title($builder, $data)
    {
        $builder->where('title', 'ilike', "%{$data}%");
    }
}
