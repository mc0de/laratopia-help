<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdcategoryRequest;
use App\Http\Requests\UpdateAdcategoryRequest;
use App\Http\Resources\Admin\AdcategoryResource;
use App\Models\Adcategory;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdcategoryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('adcategory_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AdcategoryResource(Adcategory::all());
    }

    public function store(StoreAdcategoryRequest $request)
    {
        $adcategory = Adcategory::create($request->validated());

        return (new AdcategoryResource($adcategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Adcategory $adcategory)
    {
        abort_if(Gate::denies('adcategory_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AdcategoryResource($adcategory);
    }

    public function update(UpdateAdcategoryRequest $request, Adcategory $adcategory)
    {
        $adcategory->update($request->validated());

        return (new AdcategoryResource($adcategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Adcategory $adcategory)
    {
        abort_if(Gate::denies('adcategory_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $adcategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
