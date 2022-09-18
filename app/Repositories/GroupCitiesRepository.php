<?php

namespace App\Repositories;

use App\Models\GroupCities;

class GroupCitiesRepository implements Interfaces\GroupCitiesInterface
{

    protected $groupCities;

    public function __construct(GroupCities $groupCities)
    {
        $this->groupCities = $groupCities;
    }

    public function getAll()
    {
        return $this->groupCities->simplePaginate();
    }

    public function getOne($id)
    {
        return $this->groupCities->with('cities')->find($id);
    }

    public function update(object $groupCities, array $data)
    {
        return $groupCities->update($data);
    }

    public function create(array $data)
    {
        return $this->groupCities->create($data);
    }

    public function delete(object $groupCities)
    {
        return $groupCities->delete();
    }
}
