<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\User\Entities\RegisterInvitation;

class RegisterInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    public $invitation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(RegisterInvitation $registerInvitation)
    {
        $this->invitation = $registerInvitation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.register.register-invitation');
    }
}
