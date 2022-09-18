<?php

namespace App\Http\Services;

use App\Repositories\Interfaces\CityInterface;
use Exception;

class CityService {

    protected CityInterface $city;

    public function __construct(CityInterface $cityRepository) {
        $this->city = $cityRepository;
    }

    public function create(array $data) {
        $data['group_cities_id'] = null; //GARANTE QUE EU NÃO CRIE UMA CIDADE JÁ COM GRUPO
        return $this->city->create($data);
    }

    public function getAll() {
        return $this->city->getAll();
    }

    /**
     * @throws Exception
     */
    public function getOne($id) {
        $city = $this->city->getOne($id);

        if (is_null($city)){
            throw new Exception("City not found!", 404);
        }

        return $city;
    }

    /**
     * @throws Exception
     */
    public function update(array $data, $id) {
        $city = $this->city->getOne($id);

        if (is_null($city)){
            throw new Exception("City not found!", 404);
        }

        $updated = $this->city->update($city, $data);

        if (!$updated) {
            throw new Exception("Error when updating!", 400);
        }

        return $this->city->getOne($id);
    }

    /**
     * @throws Exception
     */
    public function delete($id): array
    {
        $city = $this->city->getOne($id);

        if (is_null($city)){
            throw new Exception("City not found!", 404);
        }

        $updated = $this->city->delete($city);

        if (!$updated) {
            throw new Exception("Error removing!", 400);
        }

        return [];
    }

}
