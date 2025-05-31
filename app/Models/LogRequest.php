<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogRequest extends Model
{
    public function logEvents()
    {
        return $this->hasMany(LogEvent::class);
    }
}
