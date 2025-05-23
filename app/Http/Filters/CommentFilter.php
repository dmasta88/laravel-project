<?php

namespace App\Http\Filters;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class CommentFilter extends AbstractFilter
{
    protected array $keys = [
        'content',
        'profile_id',
        'published_at_from',
        'category_title',
        'post_id'
    ];

    protected function content($builder, $data)
    {
        $builder->where('content', 'ilike', "%{$data}%");
    }
    protected function publishedAtFrom($builder, $data)
    {
        $builder->where('published_at', '>', $data);
    }
    protected function categoryTitle($builder, $data)
    {
        $builder->whereHasMorph('commentable', [\App\Models\Post::class], function ($query) use ($data) {
            $query->whereRelation('category', 'title', 'ilike', '%' . $data . '%');
        });
    }

    protected function postId($builder, $data)
    {
        $builder->where('commentable_type', Post::class)->where('commentable_id', $data);
    }
}
