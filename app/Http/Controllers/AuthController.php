<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function onGetRequest(Request $r)
    {
        if (User::where('email', '=', 'master.alex@localhost')->count() < 1) {
            User::create([
                'name' => 'Alex Alexeev',
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
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $admin = $r->has('is-admin') && $r->get('is-admin', 'off') == 'on' ? 'admin' : 'user';

        try {
            $user = User::create([
                'name' => $r->get('name'),
                'email' => $r->get('email'),
                'password' => $r->get('password'),
                'account_type' => $admin
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
        Auth::login($user);

        if (Auth::check()) {
            $r->session()->regenerate();
            return redirect('/auth');
        } else {
            return back()->withErrors(['Неверный логин или пароль.']);
        }
    }
}
