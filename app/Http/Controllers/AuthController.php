<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Termwind\render;

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

        if (Auth::check())
        {
            return redirect('/lk');
        }
        else
        {
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

        User::create([
            'name' => $r->get('name'),
            'email' => $r->get('email'),
            'password' => $r->get('password'),
            'account_type' => $admin
        ]);

        Auth::attempt(['email' => $r->get('email'), 'password' => $r->get('password')]);

        return redirect('/lk');
    }

    public function onAuthAction(Request $r)
    {
        $cred = $r->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($cred)) {
            $r->session()->regenerate();
            return redirect('/');
        } else {
            return back()->withErrors(['Неверный логин или пароль.']);
        }
    }
}
