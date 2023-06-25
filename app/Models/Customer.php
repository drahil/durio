<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function reservations()
    {
        $this->hasMany(Reservation::class);
    }

    public function workers()
    {
        $this->belongsToMany(Reservation::class);
    }


}
