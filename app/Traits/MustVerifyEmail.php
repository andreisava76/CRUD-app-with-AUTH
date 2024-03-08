<?php

namespace App\Traits;

use App\Notifications\sendVerifyEmail;
use Exception;

trait MustVerifyEmail
{
    /**
     * @return bool
     */
    public function hasVerifiedEmail(): bool
    {
        return !is_null($this->email_verified_at);
    }

    /**
     * @return bool
     */
    public function markEmailAsVerified(): bool
    {
        return $this->forceFill([
            'verification_code' => NULL,
            'email_verified_at' => $this->freshTimestamp(),
            'attempts_left' => 0,
        ])->save();
    }

    /**
     * @throws Exception
     */
    public function sendEmailVerificationNotification(bool $newData = false): void
    {
        if ($newData) {
            $this->forceFill([
                'verification_code' => random_int(111111, 999999),
                'attempts_left' => config('verification.max_attempts'),
                'verification_code_sent_at' => now(),
            ])->save();
        }
        $this->notify(new sendVerifyEmail);
    }
}
