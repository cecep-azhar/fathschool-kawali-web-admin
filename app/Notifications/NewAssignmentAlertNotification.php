<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class NewAssignmentAlertNotification extends Notification implements ShouldQueue
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
            ->subject('Invited to complete a assignment')
            ->greeting('Hi, '.$this->student->name)
            ->line('You have been selected to participate in an assignment. Please review the assignment details using the following information.')
            ->line(new HtmlString(
                "Title: {$this->assignment->title}".'<br>'.
                    "Assignment Created Date : {$this->assignment->issue}".'<br>'.
                    "Assignment Submit Last Date: {$this->assignment->deadline}"
            ))
            ->action('Details', route('assignment.detail', $this->assignment->slug));
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
