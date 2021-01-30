<?php

namespace App\Notifications;

use App\Mail\YourGoalIsDoneMail;
use App\Models\Goal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MarkGoalAsDoneNotification extends Notification
{
    use Queueable;

    /**
     * @var
     */
    public $goal;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Goal $goal)
    {
        $this->goal = $goal;
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
        return (new YourGoalIsDoneMail($notifiable, $this->goal))
            ->to($notifiable->email);
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
            'title' => 'Goal is done',
            'message' => __('Hello, :name your goal :goalName is done our congratulations.', [
                'name' => $notifiable->name,
                'goalName' => $this->goal->title
            ])
        ];
    }
}
