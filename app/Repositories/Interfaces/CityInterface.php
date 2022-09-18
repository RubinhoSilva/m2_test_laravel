<?php

namespace App\Repositories\Interfaces;

use App\Models\City;
use App\Repositories\Contracts\CreateContract;
use App\Repositories\Contracts\UpdateContract;
use App\Repositories\Contracts\GetOneContract;
use App\Repositories\Contracts\GetAllContract;
use App\Repositories\Contracts\DeleteContract;

interface CityInterface extends CreateContract , UpdateContract, GetOneContract, GetAllContract, DeleteContract {

    public function setGroupCity(City $city, $group_cities_id);

}
