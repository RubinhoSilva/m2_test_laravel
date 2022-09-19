<?php

namespace App\Repositories;

use App\Models\Campaign;

class CampaignRepository implements Interfaces\CampaignInterface
{

    protected Campaign $campaign;

    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    public function getAll()
    {
        return $this->campaign->with('groupCities')->simplePaginate();
    }

    public function getOne($id)
    {
        return $this->campaign->with('groupCities', 'products')->find($id);
    }

    public function update(object $campaign, array $data)
    {
        return $campaign->update($data);
    }

    public function create(array $data)
    {
        return $this->campaign->create($data);
    }

    public function delete(object $campaign)
    {
        return $campaign->delete();
    }

    public function getActivesByGroupCities($group_cities_id)
    {
        return $this->campaign->where('active', 1)->where('group_cities_id', $group_cities_id)->get();
    }
}
