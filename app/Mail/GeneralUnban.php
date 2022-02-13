<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class GeneralUnban extends Mailable
{
    use Queueable, SerializesModels;

    private User $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.ban')->subject('Vous avez été débannis')->with(['judge' => Auth::user() ,'isBanMail' => false, 'bans' => $this->user->bans]);
    }
}
