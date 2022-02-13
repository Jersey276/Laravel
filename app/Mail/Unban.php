<?php

namespace App\Mail;

use App\Models\Ban;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class Unban extends Mailable
{
    use Queueable, SerializesModels;

    private Ban $ban;

    private bool $isRemoved;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ban $ban, bool $isRemoved)
    {
        $this->ban = $ban;
        $this->isRemoved = $isRemoved;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.ban')->subject($this->isRemoved?"Un ban vous a été supprimé.":"Vous avez été debanni")->with(['isBanMail' => false, 'bans' => [], 'judge' => Auth::user(), 'ban' => $this->ban, 'isRemoved' => $this->isRemoved]);
    }
}
