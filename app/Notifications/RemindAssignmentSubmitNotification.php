<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RemindAssignmentSubmitNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $student;

    public $assignment;

    public function __construct($student, $assignment)
    {
        $this->student = $student;
        $this->assignment = $assignment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Assignment Submit Notification')
            ->greeting('Hello, '.$this->student->name)
            ->line('You have a pending assignment that needs to be submitted promptly. Ensure timely submission of your assignment. Please find the assignment details below.')
            ->line('Last Date : '.$this->assignment->deadline)
            ->action('View Details', route('assignment.detail', $this->assignment->slug))
            ->line('Best of luck!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
