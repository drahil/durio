<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\Worker;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->calculateProfit();

        return view('workers', [
            'workers' => Worker::select('id', 'name', 'profit', 'email')
                ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Worker $worker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Worker $worker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkerRequest $request, Worker $worker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Worker $worker)
    {
        //
    }

    public function calculateProfit()
    {
        $workers = Worker::all();

        foreach ($workers as $worker) {
            $totalProfit = Service::join('reservations', 'services.id', '=', 'reservations.service_id')
                ->where('reservations.worker_id', $worker->id)
                ->where('reservations.date', '<', Carbon::today())
                ->sum(DB::raw('services.price'));

            $worker->profit = $totalProfit;
            $worker->save();
        }
    }
}
