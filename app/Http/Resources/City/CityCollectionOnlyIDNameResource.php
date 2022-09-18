<?php

namespace App\Http\Resources\City;

use App\Http\PatternResponses\IPatternResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CityCollectionOnlyIDNameResource extends ResourceCollection
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\HigherOrderCollectionProxy
     */
    public function toArray($request)
    {
        return $this->collection->map->only(['id', 'name']);
    }

    public function with($request)
    {
        return [
            'name' => $this->name
        ];
    }
}
