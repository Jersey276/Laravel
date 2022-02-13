<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BanType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'duration',
        'description',
        'isDefinitive'
    ];

    public $timestamps = false;

    public function bans()
    {
        return $this->hasMany(Ban::class);
    }

    public function editLink()
    {
        return "/admin/users/ban/types/". $this->id;
    }
}