<?php

namespace App\Http\Resources\City;

use App\Http\PatternResponses\IPatternResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
            'group_city' => $this->whenLoaded('groupCities')
        ]);

    }



}
