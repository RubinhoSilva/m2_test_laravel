<?php

namespace App\Http\Controllers;

use App\Http\PatternResponses\IPatternResponse;
use App\Http\Requests\Campaign\CreateUpdateRequest;
use App\Http\Resources\Campaign\CampaignCollectionResource;
use App\Http\Resources\Campaign\CampaignResource;
use App\Http\Resources\City\CityResource;
use App\Http\Resources\ExceptionResource;
use App\Http\Services\CampaignService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    protected CampaignService $campaignService;
    protected IPatternResponse $patternResponse;

    public function __construct(CampaignService $campaignService, IPatternResponse $patternResponse)
    {
        $this->campaignService = $campaignService;
        $this->patternResponse = $patternResponse;
    }

    public function store(CreateUpdateRequest $request)
    {
        DB::beginTransaction();

        try {
            $campaign = $this->campaignService->create($request->all());

            DB::commit();

            return new CampaignResource($campaign, $this->patternResponse);
        } catch (Exception $e) {

            DB::rollBack();

            return (new ExceptionResource($e, $this->patternResponse))
                ->response()
                ->setStatusCode($e->getCode() == 400 ? $e->getCode() : 500); //VERIFICO SE O ERRO ESTA VINDO DA VALIDAÇÃO, SE FOR, O ERRO SERA COM CODIGO 400
        }
    }

    public function index()
    {
        try {
            $campaigns = $this->campaignService->getAll();
            return new CampaignCollectionResource($campaigns, $this->patternResponse);
        } catch (Exception $e) {
            return (new ExceptionResource($e, $this->patternResponse))
                ->response()
                ->setStatusCode(500);
        }
    }

    public function show($id)
    {
        try {
            $campaign = $this->campaignService->getOne($id);
            return new CampaignResource($campaign, $this->patternResponse);
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
            $campaign = $this->campaignService->update($request->all(), $id);

            DB::commit();

            return new CampaignResource($campaign, $this->patternResponse);
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
            $campaign = $this->campaignService->delete($id);

            DB::commit();

            return new CityResource($campaign, $this->patternResponse);
        } catch (Exception $e) {
            DB::rollBack();

            return (new ExceptionResource($e, $this->patternResponse))
                ->response()
                ->setStatusCode($e->getCode());
        }
    }
}
