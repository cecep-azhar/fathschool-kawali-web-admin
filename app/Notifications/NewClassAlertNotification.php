<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class NewClassAlertNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $student;

    public $meeting;

    public function __construct($student, $meeting)
    {
        $this->student = $student;
        $this->meeting = $meeting;
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
            ->subject('Class Enrollment Invitation')
            ->greeting('Hi, '.$this->student->user->name)
            ->line('Invitation to Join Class: Access Class with the Provided Information')
            ->line(new HtmlString(
                "Topic: {$this->meeting->topic}".'<br>'.
                    "Description: {$this->meeting->description}".'<br>'.
                    "Class Joining Date : {$this->meeting->start_date_format}".'<br>'.
                    "Class Password: {$this->meeting->password}"
            ))
            ->action('Join Now', $this->meeting->join_url);
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
