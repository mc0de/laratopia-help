<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Http\Resources\Admin\ApplicationResource;
use App\Models\Application;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApplicationApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('application_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ApplicationResource(Application::with(['team'])->get());
    }

    public function store(StoreApplicationRequest $request)
    {
        $application = Application::create($request->validated());

        return (new ApplicationResource($application))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Application $application)
    {
        abort_if(Gate::denies('application_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ApplicationResource($application->load(['team']));
    }

    public function update(UpdateApplicationRequest $request, Application $application)
    {
        $application->update($request->validated());

        return (new ApplicationResource($application))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Application $application)
    {
        abort_if(Gate::denies('application_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $application->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
