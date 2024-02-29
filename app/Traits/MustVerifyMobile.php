<?php

namespace App\Traits;

use App\Notifications\sendVerifySMS;
use Exception;

trait MustVerifyMobile
{
    /**
     * @return bool
     */
    public function hasVerifiedMobile(): bool
    {
        return ! is_null($this->mobile_verified_at);
    }

    /**
     * @return bool
     */
    public function markMobileAsVerified(): bool
    {
        return $this->forceFill([
            'mobile_verify_code' => NULL,
            'mobile_verified_at' => $this->freshTimestamp(),
            'mobile_attempts_left' => 0,
        ])->save();
    }

    /**
     * @throws Exception
     */
    public function sendMobileVerificationNotification(bool $newData = false): void
    {
        if($newData)
        {
            $this->forceFill([
                'mobile_verify_code' => random_int(111111, 999999),
                'mobile_attempts_left' => config('mobile.max_attempts'),
                'mobile_verify_code_sent_at' => now(),
            ])->save();
        }
        $this->notify(new sendVerifySMS);
    }
}
