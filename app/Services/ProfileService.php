<?php

namespace App\Services;

use App\Models\Profile;

class ProfileService
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
        return Profile::create($data);
    }
    public static function update(array $data, Profile $profile)
    {
        $profile->update($data);
        return $profile;
    }
}
