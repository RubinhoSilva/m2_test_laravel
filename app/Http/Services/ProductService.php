<?php

namespace App\Http\Services;

use App\Repositories\Interfaces\ProductInterface;
use Exception;

class ProductService {

    protected ProductInterface $product;

    public function __construct(ProductInterface $productRepository) {
        $this->product = $productRepository;
    }

    public function create(array $data) {
        return $this->product->create($data);
    }

    public function getAll() {
        return $this->product->getAll();
    }

    /**
     * @throws Exception
     */
    public function getOne($id) {
        $city = $this->product->getOne($id);

        if (is_null($city)){
            throw new Exception("Product not found!", 404);
        }

        return $city;
    }

    /**
     * @throws Exception
     */
    public function update(array $data, $id) {
        $city = $this->product->getOne($id);

        if (is_null($city)){
            throw new Exception("Product not found!", 404);
        }

        $updated = $this->product->update($city, $data);

        if (!$updated) {
            throw new Exception("Error when updating!", 400);
        }

        return $this->product->getOne($id);
    }

    /**
     * @throws Exception
     */
    public function delete($id): array
    {
        $city = $this->product->getOne($id);

        if (is_null($city)){
            throw new Exception("Product not found!", 404);
        }

        $updated = $this->product->delete($city);

        if (!$updated) {
            throw new Exception("Error removing!", 400);
        }

        return [];
    }

}
