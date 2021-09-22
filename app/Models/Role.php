<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parents' => 'array'
    ];
    
    protected $primaryKey = "name";
    protected $keyType = "string";
    public $incrementing = false;
    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class,'role_name');
    }

    public function editLink()
    {
        return '/admin/roles/'. $this->name;
    }

    public function rules() {
        return $this->belongsToMany(Rule::class);
    }
}
