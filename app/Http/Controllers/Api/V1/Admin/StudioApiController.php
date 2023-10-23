<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudioRequest;
use App\Http\Requests\UpdateStudioRequest;
use App\Http\Resources\Admin\StudioResource;
use App\Models\Studio;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudioApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('studio_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudioResource(Studio::with(['team'])->get());
    }

    public function store(StoreStudioRequest $request)
    {
        $studio = Studio::create($request->validated());

        return (new StudioResource($studio))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Studio $studio)
    {
        abort_if(Gate::denies('studio_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudioResource($studio->load(['team']));
    }

    public function update(UpdateStudioRequest $request, Studio $studio)
    {
        $studio->update($request->validated());

        return (new StudioResource($studio))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Studio $studio)
    {
        abort_if(Gate::denies('studio_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studio->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
