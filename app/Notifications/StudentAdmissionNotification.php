<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\HtmlString;

class StudentAdmissionNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $user;

    public $courses;

    public $parents;

    public $parent;

    public $token;

    public function __construct($user, $courses, $parents, $parent, $token)
    {
        $this->user = $user;
        $this->courses = $courses;
        $this->parents = $parents;
        $this->parent = $parent;
        $this->token = $token;
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
        $child_title = $this->parent ? 'Child' : '';

        return (new MailMessage)
            ->subject("The Wait is Over - You've Been Admitted!")
            ->greeting('Hello, '.$this->user->name)
            ->line(new HtmlString('Your '.$child_title.' admission process has been successfully finalized. Kindly utilize the  provided credentials to access your account. <br>
            Your '.$child_title.'  School Name : '.config('app.name').'<br>'.
            'Your '.$child_title.'  Courses : '.implode(', ', $this->courses).'<br>'.
            'Your '.$child_title.'  Parents : '.implode(', ', $this->parents).'<br>'.
            'Account Email : '.$this->user->email
            ))
            // ->line('Please reset your ' . $child_title . '  account password to login')
            // ->action('Set Password', url('/forgot-password'))

            ->action('Set Password', url(route('password.reset', [
                'token' => $this->token,
                'email' => $this->user->email,
            ], false)))
            ->line(Lang::get('This password set link will expire in :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]));
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
