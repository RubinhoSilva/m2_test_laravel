<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository implements Interfaces\ProductInterface
{

    protected Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getAll()
    {
        return $this->product->simplePaginate();
    }

    public function getOne($id)
    {
        return $this->product->find($id);
    }

    public function update(object $product, array $data)
    {
        return $product->update($data);
    }

    public function create(array $data)
    {
        return $this->product->create($data);
    }

    public function delete(object $product)
    {
        return $product->delete();
    }
}
