<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\IndexCategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    public function index(IndexCategoryRequest $request)
    {
        $data = $request->validated();
        $categories = Category::filter($data)->get();
        return CategoryResource::collection($categories)->resolve();
    }
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        return CategoryResource::make(CategoryService::store($data))->resolve();
    }
    public function show(Category $category)
    {
        return CategoryResource::make($category)->resolve();
    }
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        CategoryService::update($category, $data);
        return CategoryResource::make($category)->resolve();
    }
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'Catgory successfully deleted']);
    }
}
