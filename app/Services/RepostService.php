<?php

namespace App\Services;

use App\Models\Repost;

class RepostService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public static function store(array $data): Repost
    {
        return Repost::create($data);
    }
    public static function update(array $data, Repost $repost): Repost
    {
        $repost->update($data);
        return $repost;
    }
}
