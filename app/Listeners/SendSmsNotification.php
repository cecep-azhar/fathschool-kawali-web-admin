<?php

namespace App\Listeners;

use App\Events\SendSMS;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Twilio\Rest\Client;

class SendSmsNotification implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(SendSMS $event)
    {
        // Check if the Twilio service is active and configured
        if (config('templatecookie.twilio_active') == true) {
            // Create a new Twilio client with the configured SID and token
            $twilio = new Client(config('templatecookie.twilio_sid'), config('templatecookie.twilio_token'));

            // Get the message to be sent from the event data
            $text = $event->data['message'];

            // Send the message to each phone number obtained from the event data
            foreach ($event->data['info'] as $user) {
                $to = $user['phone'];
                if (strpos($text, '{name}') !== false) {
                    $text = str_replace('{name}', $user['name'], $text);
                }

                if (strpos($text, '{phone}') !== false) {
                    $text = str_replace('{phone}', $user['phone'], $text);
                }

                if (strpos($text, '{email}') !== false) {
                    $text = str_replace('{email}', $user['email'], $text);
                }
                // Send the SMS using the Twilio client
                $twilio->messages->create($to, [
                    'from' => '+'.substr(config('templatecookie.twilio_from'), 3),
                    'body' => $text,
                ]);
            }
        }
    }
}
