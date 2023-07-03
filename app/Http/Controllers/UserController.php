<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
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

    public function changePassword(Request $request)
    {
        return view('users.change-password');
    }

    public function changePasswordSave(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required',
        ]);

        $auth = Auth::user();

        if (! Hash::check($request->current_password, $auth->password))
        {
            Session::flash('success', 'Current Password is Invalid');
            return redirect()->route('changePasswordSave');
        }

        if (strcmp($request->current_password, $request->new_password) == 0)
        {
            Session::flash('success', 'New password cannot be same as your current password.');
            return redirect()->route('changePasswordSave');
        }

        if (strcmp($request->new_password_confirmation, $request->new_password) != 0)
        {
            Session::flash('success', 'Passwords do not match.');
            return redirect()->route('changePasswordSave');
        }

        $user =  User::find($auth->id);

        $user->password =  $request->new_password;
        $user->save();
        Session::flash('success', 'Password changed successfully');
        return back();
    }

}
