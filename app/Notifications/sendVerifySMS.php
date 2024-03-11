<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use NotificationChannels\Smso\SmsoChannel;
use NotificationChannels\Smso\SmsoMessage;

class sendVerifySMS extends Notification
{
    public function __construct()
    {
        //
    }

    public function via($notifiable): array
    {
        return [SmsoChannel::class];
    }

    public function toSmso($notifiable): SmsoMessage
    {
        return (new SmsoMessage())
            ->content("Your verification code is {$notifiable->verification_code}")
            ->from('4')
            ->to('4' . $notifiable->mobile_number);
    }

    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
