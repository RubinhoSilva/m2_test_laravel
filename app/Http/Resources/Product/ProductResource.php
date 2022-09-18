<?php

namespace App\Http\Resources\Product;

use App\Http\PatternResponses\IPatternResponse;
use App\Http\Resources\City\CityCollectionOnlyIDNameResource;
use App\Http\Resources\City\CityCollectionResource;
use App\Http\Resources\City\CityResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    protected $patternResponse;

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
            'price' => $this->price
        ]);

    }



}
