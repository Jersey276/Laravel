<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public const START_DATE  = 0;
    public const END_DATE = 1;
    public const CREATE_DATE = 2;
    public const UPDATE_DATE = 3;

    protected $fillable = [
        'title',
        'slug',
        'text',
        'technology',
        'startedAt',
        'finishedAt',
        'isVisible',
    ];

    public function displayLink()
    {
        return "/projects/" . $this->title;
    }

    public function modifyLink()
    {
        return "/admin/projects/" . $this->id;
    }

    public function deleteLink()
    {
        return "/admin/projects/" . $this->id;
    }

    public function displayDate(int $dateType) : ?string
    {
        switch($dateType)
        {
            case(self::START_DATE):
                $date = new Carbon($this->startedAt);
            case(self::END_DATE):
                $date = new Carbon($this->finishedAt);
            case(self::CREATE_DATE):
                $date = new Carbon($this->createdAt);
            case(self::UPDATE_DATE):
                $date = new Carbon($this->updateAt);
            default :
                return null;
        }
        return $date->locale('fr')->monthName() . ' ' . $date->year();
    }
}
