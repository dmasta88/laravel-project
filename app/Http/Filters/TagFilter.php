<?php

namespace App\Http\Filters;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class TagFilter extends AbstractFilter
{
    protected array $keys = [
        'title',
    ];

    protected function title($builder, $data)
    {
        $builder->where('title', 'ilike', "%{$data}%");
    }
}
