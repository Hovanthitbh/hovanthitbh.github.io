<?php

namespace App\Http\Controllers;

use Illuminate\Filesystem\Cache;
use Illuminate\Http\Request;

class VerifyOTPController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware(['TwoFA']);
//    }

    public  function verify(Request $request){
        if(request('otp') == $_SESSION['OTP']){
            auth()->user()->update(['is_verified'=>true]);
            unset($_SESSION['OTP']);
            return redirect('/home');
        }
        return redirect()->back()->with('status', 'wrong authentication code');;
    }

    public function showVerifyPage(){
        return view('OTP.verify');
    }
}
