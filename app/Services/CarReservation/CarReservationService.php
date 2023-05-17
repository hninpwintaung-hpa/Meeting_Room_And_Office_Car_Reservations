<?php

namespace App\Services\CarReservation;

use App\Models\CarReservation;
use Carbon\Carbon;

class CarReservationService implements CarReservationServiceInterface
{
    public function store($data)
    {
        $currentDateTime = Carbon::now();
        $inputDate = Carbon::parse($data['date']);

        if ($inputDate < $currentDateTime) {
            return "Please select the date greater than current date.";
        }
        $inputCarId = $data['car_id'];
        //$inputDate = $data['date'];
        $existingReservation = CarReservation::where('car_id', $inputCarId)
            ->where('date', $inputDate)
            ->where('status', 1)
            ->first();
        if ($existingReservation) {
            return "Unable to make reservation within this time.";
            exit();
        }

        return CarReservation::create($data);
    }
    public function update($data, $id)
    {
        $currentDateTime = Carbon::now();
        $inputDate = Carbon::parse($data['date']);

        if ($inputDate < $currentDateTime) {
            return "Please select the date greater than current date.";
        }
        $inputCarId = $data['car_id'];
        //$inputDate = $data['date'];
        $existingReservation = CarReservation::where('car_id', $inputCarId)
            ->where('date', $inputDate)
            ->where('status', 1)
            ->first();

        if ($existingReservation) {
            return "Unable to make reservation within this time.";
            exit();
        }
        $carReservation = CarReservation::where('id', $id)->first();
        return $carReservation->update($data);
    }
    public function delete($id)
    {
        return CarReservation::where('id', $id)->delete();
    }
}
