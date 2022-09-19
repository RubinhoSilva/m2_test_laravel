<?php

namespace App\Repositories;

use App\Models\CampaignProduct;

class CampaignProductRepository implements Interfaces\CampaignProductInterface
{

    protected CampaignProduct $campaignProduct;

    public function __construct(CampaignProduct $campaignProduct)
    {
        $this->campaignProduct = $campaignProduct;
    }

    public function getAll()
    {
        return $this->campaignProduct->simplePaginate();
    }

    public function getOne($id)
    {
        return $this->campaignProduct->find($id);
    }

    public function update(object $campaignProduct, array $data)
    {
        return $campaignProduct->update($data);
    }

    public function create(array $data)
    {
        return $this->campaignProduct->create($data);
    }

    public function delete(object $campaignProduct)
    {
        return $campaignProduct->delete();
    }
}
