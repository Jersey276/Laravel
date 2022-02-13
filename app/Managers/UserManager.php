<?php

namespace App\Managers;

use App\Models\User;
use Illuminate\Support\Facades\Date;

class UserManager
{
    public function isBanned(User $user) : bool
    {
        $now = Date::now();
        $bans = $user->bans;
        foreach($bans as $ban) {
            if ($ban->isActive) {
                if (($ban->endedAt != null && $ban->endedAt >= $now) || $ban->bantype->isDefinitive) {
                    return true;
                }
                $ban->isActive = false;
                $ban->save();
            }
        }
        return false;
    }
}