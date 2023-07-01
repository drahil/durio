<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->calculateProfit();

        return view('users.index', [
            'users' => User::select('id', 'name', 'profit', 'email')
                ->where('role', '=', 'worker')
                ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        User::create(array_merge($this->validateUser(), [
            'role' => 'worker',
        ]));
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkerRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function calculateProfit()
    {
        $users = User::where('role', '=', 'worker')->get();

        foreach ($users as $user) {
            $totalProfit = Service::join('reservations', 'services.id', '=', 'reservations.service_id')
                ->where('reservations.worker_id', $user->id)
                ->where('reservations.date', '<', Carbon::today())
                ->sum(DB::raw('services.price'));

            $user->profit = $totalProfit;
            $user->save();
        }
    }

    private function validateUser(? User $user = null) :array
    {
        $user ??= new User();

        $user->role = 'worker';

        return request()->validate([
            'name' => ['required'],
            'email' => ['required', Rule::unique('users', 'email')],
            'password' => ['required'],
        ]);
    }
}
