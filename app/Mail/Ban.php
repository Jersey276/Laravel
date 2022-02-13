<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Models\Ban as ModelBan;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Ban extends Mailable
{
    use Queueable, SerializesModels;

    private ModelBan $ban;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ModelBan $ban)
    {
        $this->ban = $ban;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.ban')->with(['ban' => $this->ban]);
    }
}
