<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function service()
    {
        return $this->hasMany(Service::class);
    }

}
