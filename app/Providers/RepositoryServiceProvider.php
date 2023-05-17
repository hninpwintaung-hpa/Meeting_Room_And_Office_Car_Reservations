<?php

namespace App\Providers;

use App\Repository\Car\CarRepoInterface;
use App\Repository\Car\CarRepository;

use App\Repository\CarReservation\CarReservationRepoInterface;
use App\Repository\CarReservation\CarReservationRepository;

use App\Repository\RoomReservation\RoomReservationRepoInterface;
use App\Repository\RoomReservation\RoomReservationRepository;

use App\Services\RoomReservation\RoomReservationService;
use App\Services\RoomReservation\RoomReservationServiceInterface;

use App\Repository\Room\RoomRepoInterface;
use App\Repository\Room\RoomRepository;
use App\Services\Car\CarService;
use App\Services\Car\CarServiceInterface;
use App\Services\CarReservation\CarReservationService;
use App\Services\CarReservation\CarReservationServiceInterface;

use App\Services\Room\RoomService;
use App\Services\Room\RoomServiceInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(CarRepoInterface::class, CarRepository::class);
        $this->app->bind(CarServiceInterface::class, CarService::class);

        $this->app->bind(RoomRepoInterface::class, RoomRepository::class);
        $this->app->bind(RoomServiceInterface::class, RoomService::class);

        $this->app->bind(CarReservationRepoInterface::class, CarReservationRepository::class);
        $this->app->bind(CarReservationServiceInterface::class, CarReservationService::class);

        $this->app->bind(RoomReservationRepoInterface::class, RoomReservationRepository::class);
        $this->app->bind(RoomReservationServiceInterface::class, RoomReservationService::class);
    }
}
