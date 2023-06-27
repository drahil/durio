<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class);
    }

    public function workers()
    {
        return $this->belongsToMany(Worker::class);
    }
}
