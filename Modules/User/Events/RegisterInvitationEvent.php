<?php

namespace Modules\User\Events;

use Illuminate\Queue\SerializesModels;
use Modules\User\Entities\RegisterInvitation;

class RegisterInvitationEvent
{
    use SerializesModels;

    /**
     * @var
     */
    public $registerInvitation;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(RegisterInvitation $row)
    {
        $this->registerInvitation = $row;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }


    /**
     * Get invitation
     * @return RegisterInvitation
     */
    public function invitation()
    {
        return $this->registerInvitation;
    }
}
