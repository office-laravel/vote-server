<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;


class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        // تحقق مما إذا كان المستخدم موجوداً في قاعدة البيانات
        $user = Client::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // إذا لم يكن موجوداً، قم بإنشائه
            $user = Client::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => bcrypt(uniqid()), // يمكنك استخدام كلمة مرور عشوائية
            ]);
        }

        // تسجيل الدخول للمستخدم
        Auth::guard('client')->login($user, true);

        // return redirect()->to('/home'); // أو أي صفحة أخرى تريد توجيه المستخدم إليها
        return redirect()->route('site.home');
    
    }
}
