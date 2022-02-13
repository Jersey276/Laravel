<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

class Ban extends Model
{
    use HasFactory;

    protected $fillable = [
        'isActive',
        'startedAt',
        'endedAt',
        'commentary'
    ];

    public $timestamps = false;

    public function unbanLink() : string
    {
        return '/admin/users/banned/'.$this->user->id .'/unban/'. $this->id;
    }

    public function bantype() {
        return $this->belongsTo(BanType::class,'ban_types_id');
    }

    public function user() {
        return $this->belongsTo(User::class,'user_ban');
    }

    public function judge() {
        return $this->belongsTo(User::class,'user_judge');
    }
}
