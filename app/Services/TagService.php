<?php

namespace App\Services;

use App\Models\Tag;
use PhpParser\Node\Expr\FuncCall;

class TagService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public static function store(array $data)
    {
        return Tag::create($data);
    }
    public static function update(array $data, Tag $tag)
    {
        $tag->update($data);
        return $tag;
    }
    public static function storeBatch(array $data): array
    {
        $tags = [];
        foreach ($data as $tag) {
            $tags[] = Tag::firstOrCreate(['title' => $tag]);
        }
        return $tags;
    }
}
