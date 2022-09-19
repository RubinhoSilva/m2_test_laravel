<?php

namespace App\Http\Controllers;

use App\Http\PatternResponses\IPatternResponse;
use App\Http\Requests\GroupCities\CreateUpdateRequest;
use App\Http\Resources\ExceptionResource;
use App\Http\Resources\GroupCities\GroupCitiesCollectionResource;
use App\Http\Resources\GroupCities\GroupCitiesResource;
use App\Http\Services\GroupCitiesService;
use Exception;
use Illuminate\Support\Facades\DB;

class GroupCitiesController extends Controller
{
    protected GroupCitiesService $groupCitiesService;
    protected IPatternResponse $patternResponse;

    public function __construct(GroupCitiesService $groupCitiesService, IPatternResponse $patternResponse)
    {
        $this->groupCitiesService = $groupCitiesService;
        $this->patternResponse = $patternResponse;
    }

    public function store(CreateUpdateRequest $request)
    {
        DB::beginTransaction();

        try {
            $groupCities = $this->groupCitiesService->create($request->all());

            DB::commit();

            return new GroupCitiesResource($groupCities, $this->patternResponse);
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
            $groupsCities = $this->groupCitiesService->getAll();
            return new GroupCitiesCollectionResource($groupsCities, $this->patternResponse);
        } catch (Exception $e) {
            return (new ExceptionResource($e, $this->patternResponse))
                ->response()
                ->setStatusCode(500);
        }
    }

    public function show($id)
    {
        try {
            $groupCities = $this->groupCitiesService->getOne($id);
            return new GroupCitiesResource($groupCities, $this->patternResponse);
        } catch (Exception $e) {
            return (new ExceptionResource($e, $this->patternResponse))
                ->response()
                ->setStatusCode($e->getCode());
        }
    }

    public function update(CreateUpdateRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $groupCities = $this->groupCitiesService->update($request->all(), $id);

            DB::commit();

            return new GroupCitiesResource($groupCities, $this->patternResponse);
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
            $groupCities = $this->groupCitiesService->delete($id);

            DB::commit();

            return new GroupCitiesResource($groupCities, $this->patternResponse);
        } catch (Exception $e) {
            DB::rollBack();

            return (new ExceptionResource($e, $this->patternResponse))
                ->response()
                ->setStatusCode($e->getCode());
        }
    }

}
