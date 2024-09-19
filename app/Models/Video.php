<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function alreadyBookmarked()
    {
        return auth()->user()->bookmarkedVideos->contains($this->id);
    }
}
