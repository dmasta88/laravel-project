<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
    public function getHumanDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    public function getIsOwnerAttribute()
    {
        return $this->profile_id === Auth::user()->profile->id;
    }
}
