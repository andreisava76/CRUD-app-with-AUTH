<?php

namespace App\Notifications;

use App\NotificationChannel\SmsoChannel;
use App\NotificationChannel\SmsoMessage;
use Illuminate\Notifications\Notification;

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
