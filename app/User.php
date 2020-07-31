<?php

namespace App;

use App\Mail\OTPMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Filesystem\Cache;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
//session_start();

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','is_verified',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

//    public  function OTP(){
//        return Cache::get($this->OTPKey());
//    }
//
//    public  function OTPKey(){
//        return "OTP_for_{$this->id}";
//    }
//
//    public function cacheTheOTP(){
//        $OTP = rand(100000, 999999);
//        Cache::put([$this->OTPKey()=>$OTP],now()->addSeconds(20));
//        return $OTP;
//    }

    public  function sendOTP(){
        $OTP = rand(100000, 999999);
        $_SESSION['OTP'] = $OTP;
        $_SESSION['retain_login'] = $OTP;
        $_SESSION['is_verified'] = $OTP;
        Mail::to(auth()->user()->email)->send(new OTPMail($OTP));
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function addNew($input)
    {
        $check = static::where('facebook_id',$input['facebook_id'])->first();

        if(is_null($check)){
            return static::create($input);
        }

        return $check;

    }
}
