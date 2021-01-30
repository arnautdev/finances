<?php

namespace App\Mail;

use App\Models\Goal;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class YourGoalIsDoneMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public $goal;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Goal $goal)
    {
        $this->user = $user;
        $this->goal = $goal;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails/your-goal-is-done');
    }
}
