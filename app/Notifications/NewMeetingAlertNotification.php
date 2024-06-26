<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class NewMeetingAlertNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $attendee;

    public $meeting;

    public function __construct($attendee, $meeting)
    {
        $this->attendee = $attendee;
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
            ->subject('Announcement: Upcoming Meeting Notice!')
            ->greeting('Hi, '.$this->attendee->name)
            ->line($this->meeting->topic)
            ->line($this->meeting->description)
            ->line('Below are the details to join the meeting.')
            ->line(new HtmlString(
                'Meeting Joining Date : '.$this->meeting->start_date_format.'<br>'.
                    'Meeting Password : '.$this->meeting->password
            ))
            ->action('Join', $this->meeting->meeting_join_url);
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
