<?php

namespace App\Http\Services;

use App\Repositories\Interfaces\CityInterface;
use App\Repositories\Interfaces\GroupCitiesInterface;
use Exception;

class GroupCitiesService {

    protected GroupCitiesInterface $groupCities;
    protected CityInterface $city;

    public function __construct(GroupCitiesInterface $groupCitiesRepository, CityInterface $cityRepository) {
        $this->groupCities = $groupCitiesRepository;
        $this->city = $cityRepository;
    }

    public function create(array $data) {
        $groupCities = $this->groupCities->create($data);

        foreach ($data['cities'] as $city_id) {
            $city = $this->city->getOne($city_id);
            $this->city->setGroupCity($city, $groupCities->id);
        }

        return $groupCities;
    }

    public function getAll() {
        return $this->groupCities->getAll();
    }

    /**
     * @throws Exception
     */
    public function getOne($id) {
        $groupCities =  $this->groupCities->getOne($id);

        if (is_null($groupCities)){
            throw new Exception("Group cities not found!", 404);
        }

        return $groupCities;
    }

    /**
     * @throws Exception
     */
    public function update(array $data, $id) {
        $groupCities = $this->groupCities->getOne($id);

        if (is_null($groupCities)){
            throw new Exception("Group cities not found!", 404);
        }

        $updated = $this->groupCities->update($groupCities, $data);

        foreach ($data['cities'] as $city_id) {
            $city = $this->city->getOne($city_id);
            $this->city->setGroupCity($city, $groupCities->id);
        }

        if (!$updated) {
            throw new Exception("Error when updating!", 400);
        }

        return $this->groupCities->getOne($id);
    }

    /**
     * @throws Exception
     */
    public function delete($id): array
    {
        $groupCities = $this->groupCities->getOne($id);

        if (is_null($groupCities)){
            throw new Exception("Group cities not found!", 404);
        }

        $updated = $this->groupCities->delete($groupCities);

        if (!$updated) {
            throw new Exception("Error removing!", 400);
        }

        return [];
    }

}
