<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadTrait;
use App\Http\Requests\StoreAdRequest;
use App\Http\Requests\UpdateAdRequest;
use App\Http\Resources\Admin\AdResource;
use App\Models\Ad;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdApiController extends Controller
{
    use MediaUploadTrait;

    public function index()
    {
        abort_if(Gate::denies('ad_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AdResource(Ad::with(['project', 'category', 'team'])->get());
    }

    public function store(StoreAdRequest $request)
    {
        $ad = Ad::create($request->validated());
        $ad->category()->sync($request->input('category', []));
        foreach ($request->input('ad_file', []) as $file) {
            $ad->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('ad_file');
        }

        return (new AdResource($ad))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Ad $ad)
    {
        abort_if(Gate::denies('ad_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AdResource($ad->load(['project', 'category', 'team']));
    }

    public function update(UpdateAdRequest $request, Ad $ad)
    {
        $ad->update($request->validated());
        $ad->category()->sync($request->input('category', []));
        if (count($ad->ad_file) > 0) {
            foreach ($ad->ad_file as $media) {
                if (! in_array($media->file_name, $request->input('ad_file', []))) {
                    $media->delete();
                }
            }
        }
        $media = $ad->ad_file->pluck('file_name')->toArray();
        foreach ($request->input('ad_file', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $ad->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('ad_file');
            }
        }

        return (new AdResource($ad))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Ad $ad)
    {
        abort_if(Gate::denies('ad_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ad->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
