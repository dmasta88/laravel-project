<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public static function store($data)
    {
        return Category::create($data);;
    }
    public static function update(Category $category, $data)
    {
        return $category->update($data);
    }
}
