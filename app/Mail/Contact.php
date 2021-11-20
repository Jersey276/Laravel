<?php

namespace App\Mail;

use App\Models\Contact as ModelsContact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    private ModelsContact $contact;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ModelsContact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.contact',['contact' => $this->contact]);
    }
}
