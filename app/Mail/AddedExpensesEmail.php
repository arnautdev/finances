<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AddedExpensesEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    public $user;

    /**
     * @var
     */
    public $expenses;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $expenses)
    {
        $this->user = $user;
        $this->expenses = $expenses;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.added-expenses-email');
    }
}
