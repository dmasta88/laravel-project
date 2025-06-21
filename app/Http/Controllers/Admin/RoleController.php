<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Role\RoleResource;
use Inertia\Inertia;

class RoleController extends Controller
{
    public function index()
    {
        $roles = RoleResource::collection(Role::all())->resolve();
        return Inertia::render('Admin/Role/Index', compact('roles'));
    }
    public function show(Role $role)
    {
        $role = RoleResource::make($role)->resolve();
        return Inertia::render('Admin/Role/Show', compact('role'));
    }
}
