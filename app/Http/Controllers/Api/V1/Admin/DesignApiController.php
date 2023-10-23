<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadTrait;
use App\Http\Requests\StoreDesignRequest;
use App\Http\Requests\UpdateDesignRequest;
use App\Http\Resources\Admin\DesignResource;
use App\Models\Design;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DesignApiController extends Controller
{
    use MediaUploadTrait;

    public function index()
    {
        abort_if(Gate::denies('design_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DesignResource(Design::with(['project', 'post', 'team'])->get());
    }

    public function store(StoreDesignRequest $request)
    {
        $design = Design::create($request->validated());

        foreach ($request->input('design_design', []) as $file) {
            $design->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('design_design');
        }

        return (new DesignResource($design))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Design $design)
    {
        abort_if(Gate::denies('design_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DesignResource($design->load(['project', 'post', 'team']));
    }

    public function update(UpdateDesignRequest $request, Design $design)
    {
        $design->update($request->validated());

        if (count($design->design_design) > 0) {
            foreach ($design->design_design as $media) {
                if (! in_array($media->file_name, $request->input('design_design', []))) {
                    $media->delete();
                }
            }
        }
        $media = $design->design_design->pluck('file_name')->toArray();
        foreach ($request->input('design_design', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $design->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('design_design');
            }
        }

        return (new DesignResource($design))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Design $design)
    {
        abort_if(Gate::denies('design_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $design->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
