<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'image', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getExcerpt($limit = 20)
    {
        return Str::words($this->body, $limit, '...');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
