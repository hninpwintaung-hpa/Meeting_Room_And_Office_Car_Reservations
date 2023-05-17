<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\RoomReservation\RoomReservationRepoInterface;
use App\Services\RoomReservation\RoomReservationServiceInterface;
use Exception;
use Illuminate\Http\Request;

class RoomReservationController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private  $roomReservationRepo, $roomReservationService;
    public function __construct(RoomReservationRepoInterface $roomReservationRepo, RoomReservationServiceInterface $reservationService)
    {
        $this->roomReservationService = $reservationService;
        $this->roomReservationRepo =  $roomReservationRepo;
    }
    public function index()

    {
        try {
            $reservation = $this->roomReservationRepo->get();
            return $this->sendResponse($reservation, 'Data Show Successfully');
        } catch (Exception $e) {
            return $this->sendError('Error', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required',
                'title' => 'required',
                'description' => 'nullable',
                'start_time' => 'required',
                'end_time' => 'required|after:start_time',
                'date' => 'required',
                'room_id' => 'required',
            ]);

            $reservation = $this->roomReservationService->store($request->all());
            return $this->sendResponse($reservation, 'Created Successfully');
        } catch (Exception $e) {
            return $this->sendError('Error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $data = $this->roomReservationRepo->show($id);
            return $this->sendResponse($data, 'Data Show Successfully');
        } catch (Exception $e) {
            return $this->sendError('Error', $e->getMessage());
        }
    }
    public function searchByDate(Request $request)
    {
        try {
            $data = $this->roomReservationRepo->searchByDate($request->date);
            return $this->sendResponse($data, 'Data show by selected date');
        } catch (Exception $e) {
            return $this->sendError('Error', $e->getMessage());
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $input = $request->validate([
                'user_id' => 'required',
                'title' => 'required',
                'description' => 'required',
                'start_time' => 'required',
                'end_time' => 'required|after:start_time',
                'date' => 'required',
                'room_id' => 'required',
            ]);

            $data = $this->roomReservationService->update($input, $id);
            return $this->sendResponse($data, 'Updated Successfully');
        } catch (Exception $e) {
            return $this->sendError('Error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = $this->roomReservationService->delete($id);
            return $this->sendResponse($data, 'Deleted Successfully');
        } catch (Exception $e) {
            return $this->sendError('Error', $e->getMessage());
        }
    }
}