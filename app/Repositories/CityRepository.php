<?php

namespace App\Repositories;

use App\Models\City;

class CityRepository implements Interfaces\CityInterface
{

    protected City $city;

    public function __construct(City $city)
    {
        $this->city = $city;
    }

    public function getAll()
    {
        return $this->city->with('groupCities')->simplePaginate();
    }

    public function getOne($id)
    {
        return $this->city->with('groupCities')->find($id);
    }

    public function update(object $city, array $data)
    {
        return $city->update($data);
    }

    public function create(array $data)
    {
        return $this->city->create($data);
    }

    public function delete(object $city)
    {
        return $city->delete();
    }

    public function setGroupCity(City $city, $group_cities_id)
    {
        $city->group_cities_id = $group_cities_id;
        $city->save();
    }
}
