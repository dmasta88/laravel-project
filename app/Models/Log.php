<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $casts = [
        'old_attributes' => 'array',
        'new_attributes' => 'array',
    ];
}
