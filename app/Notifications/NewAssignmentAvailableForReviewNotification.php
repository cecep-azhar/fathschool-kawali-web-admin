<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class NewAssignmentAvailableForReviewNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $teacher;

    public $student;

    public $assignment;

    public function __construct($teacher, $student, $assignment)
    {
        $this->teacher = $teacher;
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
            ->subject('Invited to review a assignment')
            ->greeting('Hi, '.$this->teacher->name)
            ->line($this->student->name.' have been submitted a new assignment. Please check the assignment using the following information for mark as completed.')
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
