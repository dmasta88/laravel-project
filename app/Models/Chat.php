<?php

namespace App\Models;

use App\Models\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    use HasFilter;
    protected $guarded = [];
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
