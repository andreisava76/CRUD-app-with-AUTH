<?php

namespace App\Models;

use App\Mail\VerificationCodeMail;
use App\Notifications\sendVerifySMS;
use App\Traits\MustVerifyEmail;
use App\Traits\MustVerifyMobile;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UuidTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'mobile_number',
        'mobile_verified_at',
        'verification_code',
        'verification_code_sent_at',
        'attempts_left',
        'last_attempt_date',
        'google_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
        'verification_code_sent_at' => 'datetime',
        'last_attempt_date' => 'datetime'
    ];

    public function routeNotificationForSmso($notification)
    {
        return $this->mobile_number;
    }

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
            'verification_code' => NULL,
            'mobile_verified_at' => $this->freshTimestamp(),
            'attempts_left' => 0,
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
                'verification_code' => random_int(111111, 999999),
                'attempts_left' => config('verification.max_attempts'),
                'verification_code_sent_at' => now(),
                'preffered_verification_method' => 'mobile'
            ])->save();
        }
        $this->notify(new sendVerifySMS);
    }

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
    public function sendEmailVerification($user_email, $verification_code, $user_name): void
    {
        Mail::to($user_email)->send(new VerificationCodeMail($user_email, $verification_code, $user_name));
        $this->forceFill([
            'verification_code' => $verification_code,
            'attempts_left' => config('verification.max_attempts'),
            'verification_code_sent_at' => now(),
            'preffered_verification_method' => 'email',
        ])->save();
    }
}
