<?php

namespace App\Http\Filters;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class PostFilter extends AbstractFilter
{
    protected array $keys = [
        'title',
        'content',
        'is_active',
        'profile_id',
        'views_from',
        'category_id',
        'category_title',
        'published_at_from'
    ];

    protected function title($builder, $data)
    {
        $builder->where('title', 'ilike', "%{$data}%");
    }
    protected function content($builder, $data)
    {
        $builder->where('content', 'ilike', "%{$data}%");
    }
    protected function publishedAtFrom($builder, $data)
    {
        $builder->where('published_at', '>', $data);
    }
    protected function categoryId($builder, $data)
    {
        $builder->where('category_id', $data);
    }
    protected function categoryTitle($builder, $data)
    {
        $builder->whereRelation('category', 'title', $data);
    }
    protected function isActive($builder, $data)
    {
        $builder->where('is_active', $data);
    }
    protected function viewsFrom($builder, $data)
    {
        $builder->where('views', '>', $data);
    }
}
