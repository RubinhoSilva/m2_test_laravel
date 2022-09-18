<?php

namespace App\Http\Services;

use App\Repositories\Interfaces\GroupCitiesInterface;
use Exception;

class GroupCitiesService {

    protected $groupCities;

    public function __construct(GroupCitiesInterface $groupCitiesRepository) {
        $this->groupCities = $groupCitiesRepository;
    }

    public function create(array $data) {
        return $this->groupCities->create($data);
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

        if (!$updated) {
            throw new Exception("Error when updating!", 400);
        }

        return $this->groupCities->getOne($id);
    }

    /**
     * @throws Exception
     */
    public function delete($id) {
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
