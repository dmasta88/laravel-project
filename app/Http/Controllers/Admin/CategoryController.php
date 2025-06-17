<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Resources\Category\CategoryResource;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $categories = CategoryResource::collection($categories)->resolve();
        return Inertia::render('Admin/Category/Index', compact('categories'));
    }
    public function show(Category $category)
    {
        $category = CategoryResource::make($category)->resolve();
        return Inertia::render('Admin/Category/Show', compact('category'));
    }
    public function create()
    {
        return Inertia::render('Admin/Category/Create');
    }
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        $category = Category::create($data);
        return CategoryResource::make($category)->resolve();
    }
}
