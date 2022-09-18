<?php

namespace App\Http\Controllers;

use App\Http\PatternResponses\IPatternResponse;
use App\Http\Requests\Product\CreateUpdateRequest;
use App\Http\Resources\ExceptionResource;
use App\Http\Resources\Product\ProductCollectionResource;
use App\Http\Resources\Product\ProductResource;
use App\Http\Services\ProductService;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected ProductService $productService;
    protected IPatternResponse $patternResponse;

    public function __construct(ProductService $productService, IPatternResponse $patternResponse)
    {
        $this->productService = $productService;
        $this->patternResponse = $patternResponse;
    }

    public function store(CreateUpdateRequest $request)
    {
        DB::beginTransaction();

        try {
            $city = $this->productService->create($request->all());

            DB::commit();

            return new ProductResource($city, $this->patternResponse);
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
            $cities = $this->productService->getAll();
            return new ProductCollectionResource($cities, $this->patternResponse);
        } catch (Exception $e) {
            return (new ExceptionResource($e, $this->patternResponse))
                ->response()
                ->setStatusCode(500);
        }
    }

    public function show($id)
    {
        try {
            $groupCities = $this->productService->getOne($id);
            return new ProductResource($groupCities, $this->patternResponse);
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
            $groupCities = $this->productService->update($request->all(), $id);

            DB::commit();

            return new ProductResource($groupCities, $this->patternResponse);
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
            $city = $this->productService->delete($id);

            DB::commit();

            return new ProductResource($city, $this->patternResponse);
        } catch (Exception $e) {
            DB::rollBack();

            return (new ExceptionResource($e, $this->patternResponse))
                ->response()
                ->setStatusCode($e->getCode());
        }
    }
}
