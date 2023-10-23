<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSystemRequest;
use App\Http\Requests\UpdateSystemRequest;
use App\Http\Resources\Admin\SystemResource;
use App\Models\System;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SystemApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('system_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SystemResource(System::with(['team'])->get());
    }

    public function store(StoreSystemRequest $request)
    {
        $system = System::create($request->validated());

        return (new SystemResource($system))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(System $system)
    {
        abort_if(Gate::denies('system_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SystemResource($system->load(['team']));
    }

    public function update(UpdateSystemRequest $request, System $system)
    {
        $system->update($request->validated());

        return (new SystemResource($system))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(System $system)
    {
        abort_if(Gate::denies('system_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $system->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
