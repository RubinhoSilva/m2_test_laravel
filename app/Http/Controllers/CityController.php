<?php

namespace App\Http\Controllers;

use App\Http\PatternResponses\IPatternResponse;
use App\Http\Requests\City\CreateRequest;
use App\Http\Requests\City\UpdateRequest;
use App\Http\Resources\City\CityCollectionResource;
use App\Http\Resources\City\CityResource;
use App\Http\Resources\ExceptionResource;
use App\Http\Services\CityService;
use Exception;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    protected CityService $cityService;
    protected IPatternResponse $patternResponse;

    public function __construct(CityService $cityService, IPatternResponse $patternResponse)
    {
        $this->cityService = $cityService;
        $this->patternResponse = $patternResponse;
    }

    public function store(CreateRequest $request)
    {
        DB::beginTransaction();

        try {
            $city = $this->cityService->create($request->all());

            DB::commit();

            return new CityResource($city, $this->patternResponse);
        } catch (Exception $e) {

            DB::rollBack();

            return (new ExceptionResource($e, $this->patternResponse))
                ->response()
                ->setStatusCode(500);
        }
    }

    public function index()
    {
        try {
            $cities = $this->cityService->getAll();
            return new CityCollectionResource($cities, $this->patternResponse);
        } catch (Exception $e) {
            return (new ExceptionResource($e, $this->patternResponse))
                ->response()
                ->setStatusCode(500);
        }
    }

    public function show($id)
    {
        try {
            $groupCities = $this->cityService->getOne($id);
            return new CityResource($groupCities, $this->patternResponse);
        } catch (Exception $e) {
            return (new ExceptionResource($e, $this->patternResponse))
                ->response()
                ->setStatusCode($e->getCode());
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $groupCities = $this->cityService->update($request->all(), $id);

            DB::commit();

            return new CityResource($groupCities, $this->patternResponse);
        } catch (Exception $e) {
            DB::rollBack();

            return (new ExceptionResource($e, $this->patternResponse))
                ->response()
                ->setStatusCode($e->getCode());
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {
            $city = $this->cityService->delete($id);

            DB::commit();

            return new CityResource($city, $this->patternResponse);
        } catch (Exception $e) {
            DB::rollBack();

            return (new ExceptionResource($e, $this->patternResponse))
                ->response()
                ->setStatusCode($e->getCode());
        }
    }
}
