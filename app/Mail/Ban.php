<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Models\Ban as ModelBan;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class Ban extends Mailable
{
    use Queueable, SerializesModels;

    private ModelBan $ban;
    private bool $unban, $isRemove;

    /**
     * Create a new message instance.
     *
     * @param ModelBan $ban
     * @param bool $unban true if this message is for ban / false if this message is for unban
     * @param bool $isRemove true if ban is remove / false if ban is only unban
     * @return void
     */
    public function __construct(ModelBan $ban, bool $unban = false, bool $isRemove = false)
    {
        $this->ban = $ban;
        $this->unban = $unban;
        $this->isRemove = $isRemove;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->unban) {
            return $this->view('mail.ban')->subject($this->isRemove?"Un ban vous a été supprimé.":"Vous avez été debanni")->with(['isBanMail' => false, 'bans' => [], 'judge' => Auth::user(), 'ban' => $this->ban, 'isRemoved' => $this->isRemove]);
        }
        return $this->view('mail.ban')->subject('Vous avez été banni')->with(['isBanMail' => true, 'ban' => $this->ban]);
        
    }
}
