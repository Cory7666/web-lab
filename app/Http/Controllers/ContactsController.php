<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class ContactsController extends Controller
{
    public function onNewRequest(Request $r)
    {
        $this->validate(
            $r,
            [
                'age' => ['bail', 'required', 'numeric', 'min:18'],
                'date' => ['required', 'date'],
                'email' => ['required', 'email'],
                'name' => ['required'],
                'sex' => ['required', 'in:m,f'],
                'telnum' => ['required', 'regex:/^\+[7|3][0-9]{9,11}$/']
            ]
        );
        return redirect('/');
    }
}
