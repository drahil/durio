<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use App\Models\Feedback;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Reservation $reservation)
    {
        return view('reservations.feedback', [
            'reservation' => $reservation,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Feedback::create(array_merge($this->validateFeedback(), [
            'reservation_id' => $request->reservation_id,
        ]));

        Session::flash('success', 'Feedback added!');

        return redirect()->route('reservations.myReservations');
    }

    /**
     * Display the specified resource.
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeedbackRequest $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback)
    {
        //
    }

    private function validateFeedback(?Feedback $feedback = null): array
    {
        $feedback ??= new Feedback();

        return request()->validate([
            'body' => ['required'],
            'rating' => ['required'],
        ]);
    }
}

