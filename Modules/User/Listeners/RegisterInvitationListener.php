<?php

namespace Modules\User\Listeners;

use App\Mail\RegisterInvitationMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class RegisterInvitationListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object $event
     * @return void
     */
    public function handle($event)
    {
        $registerInvitation = $event->invitation();
        return Mail::to($registerInvitation->email)->send(
            new RegisterInvitationMail($registerInvitation)
        );
    }
}
