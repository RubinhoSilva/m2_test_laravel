<?php

namespace App\Http\Resources\GroupCities;

use App\Http\PatternResponses\IPatternResponse;
use App\Http\Resources\City\CityCollectionOnlyIDNameResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupCitiesResource extends JsonResource
{
    protected IPatternResponse $patternResponse;

    /**
     * @param IPatternResponse $patternResponse
     */
    public function __construct($resource, IPatternResponse $patternResponse)
    {
        parent::__construct($resource);
        $this->patternResponse = $patternResponse;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($request->isMethod('DELETE')){
            return $this->patternResponse->responseSuccessful([]);
        }

        return $this->patternResponse->responseSuccessful([
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'cities' => new CityCollectionOnlyIDNameResource($this->whenLoaded('cities')),
        ]);

    }



}
