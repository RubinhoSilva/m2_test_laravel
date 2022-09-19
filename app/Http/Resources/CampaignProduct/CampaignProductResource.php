<?php

namespace App\Http\Resources\CampaignProduct;

use App\Http\PatternResponses\IPatternResponse;
use App\Http\Resources\City\CityCollectionOnlyIDNameResource;
use App\Http\Resources\City\CityCollectionResource;
use App\Http\Resources\City\CityResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignProductResource extends JsonResource
{

    /**
     * @param IPatternResponse $patternResponse
     */
    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->resource;

    }



}
