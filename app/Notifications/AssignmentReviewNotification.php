<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class AssignmentReviewNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $teacher;

    public $assignment;

    public $main_assignment;

    public function __construct($teacher, $assignment, $main_assignment)
    {
        $this->teacher = $teacher;
        $this->assignment = $assignment;
        $this->main_assignment = $main_assignment;
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
            ->subject('Request for Assignment Review')
            ->greeting('Dear '.$this->teacher->name.' Sir')
            ->line(new HtmlString(
                'My name is : '.authUser()->name.'<br>'.
                    'My id is : '.authUser()->profile->student_id.'<br>'.
                    'My roll number is : '.authUser()->profile->roll_no.'<br>'

            ))
            ->line('Here is my assignment, which was submitted on '.date('M d , Y', strtotime($this->assignment->created_at)))
            ->line('Request for Assignment Review and Grading')
            ->action('View Assignment', route('assignment.show', $this->main_assignment->id));
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
