<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        $attributes = request()->validate([
           'email' => 'required|email',
           'password' => 'required'
        ]);

        ddd(auth()->attempt($attributes));
        if (! auth()->attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'could not verify']);
        }

        session()->regenerate();

        return redirect('/')->with('success', 'You are logged in');
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
