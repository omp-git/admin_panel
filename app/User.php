<?php

namespace App;

use App\Notifications\UserResetPasswordNotification;
use App\Notifications\UserVerificationEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticate;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticate implements CanResetPassword, MustVerifyEmail
{
    use Notifiable;
    use HasRoles;

//  the User model uses the 'user' guard for authentication and permission tables
    protected $guard_name = 'user';

//  authentication guard name
    protected $guarded = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//  customize reset password email template for this model
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPasswordNotification($token));
    }

//  customize verification email template for this model
    public function sendEmailVerificationNotification()
    {
        $this->notify(new UserVerificationEmail());
    }
}
