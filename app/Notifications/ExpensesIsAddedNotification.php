<?php

namespace App\Notifications;

use App\Mail\AddedExpensesEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExpensesIsAddedNotification extends Notification
{
    use Queueable;

    public $expenses;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($expenses)
    {
        $this->expenses = $expenses;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new AddedExpensesEmail($notifiable, $this->expenses))
            ->to('dmitrii.arnaut@gmail.com');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => __('Monthly expenses is added.'),
            'message' => __('You have :count static expenses and those is added to your new month.', [
                'count' => $this->expenses->count()
            ])
        ];
    }
}
