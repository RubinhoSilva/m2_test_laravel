<?php

namespace App\Repositories\Interfaces;

use App\Repositories\Contracts\CreateContract;
use App\Repositories\Contracts\UpdateContract;
use App\Repositories\Contracts\GetOneContract;
use App\Repositories\Contracts\GetAllContract;
use App\Repositories\Contracts\DeleteContract;

interface GroupCitiesInterface extends CreateContract , UpdateContract, GetOneContract, GetAllContract, DeleteContract { }
