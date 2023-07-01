<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function index()
    {
        return view('users.dashboard', [
            'reservations' => Reservation::where('worker_id', '=', auth()->id())
                ->join('users', 'reservations.user_id', '=', 'users.id')
                ->join('services', 'reservations.service_id', '=', 'services.id')
                ->select('users.name', 'users.email', 'reservations.date', 'services.type')
                ->get(),
        ]);
    }
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

        if (! auth()->attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'could not verify']);
        }

        session()->regenerate();

        return redirect('/dashboard')->with('success', 'You are logged in');
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
