<?php

namespace App\Models;

use App\Models\Traits\HasFilter;
use Auth;
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
    public function creator()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }
    public function profiles()
    {
        return $this->belongsToMany(Profile::class)->withTimestamps();
    }
    public function getIsOwnerAttribute()
    {
        return Auth::user()->profile->id === $this->creator;
    }
}
