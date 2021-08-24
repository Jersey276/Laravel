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

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function displayLink(bool $admin = false)
    {
        if ($admin) {
            return "/admin/posts/". $this->title;
        }
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
