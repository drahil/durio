<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Validation\Rule;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
//        dd(request()->all());
        Reservation::create($this->validateReservation());

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation, User $user)
    {
        $reservations = Reservation::where('user_id', '=', $user->id)
            ->select('date')
            ->get()
            ->sortBy('date');

        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }

    private function validateReservation(?Reservation $reservation = null): array
    {
        $reservation ??= new Reservation();

        return request()->validate([
            'date' => ['required', Rule::unique('reservations', 'date')->ignore($reservation)],
            'user_id' => ['required', Rule::exists('users', 'id')],
            'name' => 'required',
            'email' => 'required',
            'service_id' => ['required', Rule::exists('services', 'id')],
        ]);
    }
}
