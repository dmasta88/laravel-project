<?php

namespace App\Models;

use App\Models\Traits\HasFilter;
use App\Models\Traits\HasLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    protected $guarded = [];
    use HasFactory;
    use HasLog;
    use SoftDeletes;
    use HasFilter;
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
