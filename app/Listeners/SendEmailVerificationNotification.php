<?php

namespace App\Listeners;

use App\Http\Events\RegisteredWithEmail;


class SendEmailVerificationNotification
{
    /**
     * Handle the event.
     *
     * @param RegisteredWithEmail $event
     * @return void
     */
    public function handle(RegisteredWithEmail $event)
    {
        $event->user->sendEmailVerificationNotification();
    }
}
