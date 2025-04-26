<?php

namespace App\Services;

use App\Models\Role;

class RoleService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public static function store(array $data): Role
    {
        $role = Role::create($data);
        return $role;
    }
    public static function update(array $data, Role $role): Role
    {
        $role->update($data);
        return $role;
    }
}
