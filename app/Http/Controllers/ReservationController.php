<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;


class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        $reservationsForWorker = Reservation::where('worker_id', '=', $user->id)
            ->select('date', 'time', 'id')
            ->get()
            ->sortBy('date');


        foreach ($reservationsForWorker as $reservationForWorker) {
            $reservationForWorker->date = Carbon::parse($reservationForWorker->date)->format('Y-m-d');
        }

        return view('reservations.index', [
            'reservationsForWorker' => $reservationsForWorker,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reservations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        try {
            Reservation::create(array_merge($this->validateReservation(), [
                'user_id' => request()->user()->id,
            ]));
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] === 1062) {
                // Integrity constraint violation error occurred
                // Flash an error message
                Session::flash('success', 'Date and time already taken.');
                return redirect()->route('reservation.create');
            }
        }

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation, User $user)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($reservation)
    {
        return view('reservations.edit', [
            'reservation' => $reservation,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Reservation $reservation)
    {
        $attributes = $this->validateReservation($reservation);
        try {
            $reservation->update($attributes);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] === 1062) {
                // Integrity constraint violation error occurred
                // Flash an error message
                Session::flash('success', 'Date and time already taken.');
                return redirect()->route('reservation.edit');
            }
        }

        Session::flash('success', 'Reservation edited successfully');

        return redirect()->route('users.reservations', $reservation->worker_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        Session::flash('success', 'Reservation deleted successfully');

        return redirect()->back();
    }

    public function myReservations()
    {
        $user = \auth()->user();
        $reservationsForGuest = Reservation::where('user_id', '=', $user->id)
            ->select('date', 'time', 'id', 'worker_id')
            ->get()
            ->sortBy('date');

        foreach ($reservationsForGuest as $reservationForGuest) {
            $reservationForGuest->date = Carbon::parse($reservationForGuest->date)->format('Y-m-d');;
        }

        return view('reservations.my-reservations', [
            'reservationsForGuest' => $reservationsForGuest,
        ]);
    }

    private function validateReservation(?Reservation $reservation = null): array
    {
        $reservation ??= new Reservation();

        if (! Auth::user()->email = 'djecevic.omar@gmail.com') {
            $reservation->user_id = Auth::id();
        }

        return request()->validate([
            'date' => ['required'],
            'time' => ['required'],
            'service_id' => ['required', Rule::exists('services', 'id')],
            'worker_id' => ['required', Rule::exists('users', 'id')],
        ]);
    }
}
