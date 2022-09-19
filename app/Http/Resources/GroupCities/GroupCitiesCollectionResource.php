<?php

namespace App\Http\Resources\GroupCities;

use App\Http\PatternResponses\IPatternResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GroupCitiesCollectionResource extends ResourceCollection
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
        return $this->patternResponse->responseSuccessful($this->collection);
    }
}
