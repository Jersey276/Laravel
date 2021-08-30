<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'slug',
        'text'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function displayLink(bool $admin = false)
    {
        return "/posts/" . $this->title;
    }

    public function modifyLink()
    {
        return '/admin/posts/' . $this->id . '/edit';
    }

    public function removeLink()
    {
        return "/admin/posts/". $this->id;
    }
}
