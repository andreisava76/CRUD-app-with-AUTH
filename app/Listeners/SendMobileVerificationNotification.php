<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;

class SendMobileVerificationNotification
{
    public function handle(Registered $event)
    {
        $event->user->sendMobileVerificationNotification(true);
    }
}
