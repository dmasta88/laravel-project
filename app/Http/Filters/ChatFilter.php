<?php

namespace App\Http\Filters;

class ChatFilter extends AbstractFilter
{
    protected array $keys = [
        'title',
        'profile_id'
    ];

    protected function title($builder, $data)
    {
        $builder->where('title', 'ilike', "%{$data}%");
    }
    protected function profileId($builder, $data)
    {
        $builder->whereRelation('profile', 'id', $data);
    }
}
