<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class UserAccountSetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public $user, public $token)
    {
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
            ->subject('Your '.ucfirst($this->user->role).' Account is Ready for Use!')
            ->greeting('Hello, '.$this->user->name)
            ->line('We are excited to inform you that your '.ucfirst($this->user->role).' account has been successfully created. You can now start using your account with the following credentials:')
            ->line('Account Email : '.$this->user->email)
            ->line('To log in and access your account, please set your account password by clicking on the link below:')
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
