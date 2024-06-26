<?php

namespace App\Notifications\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdmissionRequestPendingNotification extends Notification
{
    use Queueable;

    public $student_name;

    public $course_names;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($student_name, $course_names)
    {
        $this->student_name = $student_name;
        $this->course_names = $course_names;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
            ->subject('Admission Applied Request')
            ->line("{$this->student_name} has applied for ".implode(', ', $this->course_names))
            ->action('Admission Request', route('student.admission.index'));
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
            'title' => "{$this->student_name} has applied for ".implode(', ', $this->course_names),
            'url' => route('student.admission.index'),
        ];
    }
}
