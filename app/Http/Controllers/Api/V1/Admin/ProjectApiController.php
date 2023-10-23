<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\Admin\ProjectResource;
use App\Models\Project;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('project_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProjectResource(Project::with(['owner', 'package', 'assignee', 'team'])->get());
    }

    public function store(StoreProjectRequest $request)
    {
        $project = Project::create($request->validated());
        $project->package()->sync($request->input('package', []));
        $project->assignee()->sync($request->input('assignee', []));

        return (new ProjectResource($project))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Project $project)
    {
        abort_if(Gate::denies('project_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProjectResource($project->load(['owner', 'package', 'assignee', 'team']));
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->update($request->validated());
        $project->package()->sync($request->input('package', []));
        $project->assignee()->sync($request->input('assignee', []));

        return (new ProjectResource($project))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Project $project)
    {
        abort_if(Gate::denies('project_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $project->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
