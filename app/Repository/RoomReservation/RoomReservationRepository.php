<?php

namespace App\Repository\RoomReservation;

use App\Models\Reservation;
use App\Models\RoomReservation;

class RoomReservationRepository implements RoomReservationRepoInterface
{
    public function get()
    {
        return RoomReservation::all();
    }
    public function show($id)
    {
        return RoomReservation::where('id', $id)->first();
    }
    public function searchByDate($data)
    {
        //dd('Hello');
        //dd($data);
        return RoomReservation::whereDate('date', $data)->get();
    }
}
