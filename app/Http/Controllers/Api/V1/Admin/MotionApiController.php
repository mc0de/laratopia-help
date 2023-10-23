<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMotionRequest;
use App\Http\Requests\UpdateMotionRequest;
use App\Http\Resources\Admin\MotionResource;
use App\Models\Motion;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MotionApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('motion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MotionResource(Motion::with(['team'])->get());
    }

    public function store(StoreMotionRequest $request)
    {
        $motion = Motion::create($request->validated());

        return (new MotionResource($motion))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Motion $motion)
    {
        abort_if(Gate::denies('motion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MotionResource($motion->load(['team']));
    }

    public function update(UpdateMotionRequest $request, Motion $motion)
    {
        $motion->update($request->validated());

        return (new MotionResource($motion))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Motion $motion)
    {
        abort_if(Gate::denies('motion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $motion->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
