<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVideocategoryRequest;
use App\Http\Requests\UpdateVideocategoryRequest;
use App\Http\Resources\Admin\VideocategoryResource;
use App\Models\Videocategory;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VideocategoryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('videocategory_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VideocategoryResource(Videocategory::all());
    }

    public function store(StoreVideocategoryRequest $request)
    {
        $videocategory = Videocategory::create($request->validated());

        return (new VideocategoryResource($videocategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Videocategory $videocategory)
    {
        abort_if(Gate::denies('videocategory_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VideocategoryResource($videocategory);
    }

    public function update(UpdateVideocategoryRequest $request, Videocategory $videocategory)
    {
        $videocategory->update($request->validated());

        return (new VideocategoryResource($videocategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Videocategory $videocategory)
    {
        abort_if(Gate::denies('videocategory_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $videocategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
