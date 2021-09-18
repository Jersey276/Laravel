<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'routename'
    ];

    protected $primaryKey = "name";
    protected $keyType = "string";
    public $incrementing = false;
    public $timestamps = false;

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function editLink()
    {
        return '/admin/rules/' . $this->name;
    }
}
