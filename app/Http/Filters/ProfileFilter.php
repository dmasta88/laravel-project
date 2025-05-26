<?php

namespace App\Http\Filters;

class ProfileFilter extends AbstractFilter
{
    protected array $keys = [
        'second_name',
        'third_name',
        'avatar',
        'city',
    ];
    protected function secondName($builder, $data)
    {
        $builder->where('second_name', 'ilike', "%{$data}%");
    }
    protected function thirdName($builder, $data)
    {
        $builder->where('third_name', 'ilike', "%{$data}%");
    }
    protected function avatar($builder, $data)
    {
        if ($data == '1') {
            $builder->whereNotNull('avatar')->where('avatar', '!=', '');
        } elseif ($data == '0') {
            $builder->whereNull('avatar')->orWhere('avatar', '');
        }
    }
    protected function city($builder, $data)
    {
        $builder->where('city', 'ilike', "%{$data}%");
    }
}
