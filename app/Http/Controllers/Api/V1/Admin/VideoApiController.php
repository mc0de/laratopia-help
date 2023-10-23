<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadTrait;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Http\Resources\Admin\VideoResource;
use App\Models\Video;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VideoApiController extends Controller
{
    use MediaUploadTrait;

    public function index()
    {
        abort_if(Gate::denies('video_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VideoResource(Video::with(['project', 'post', 'category', 'team'])->get());
    }

    public function store(StoreVideoRequest $request)
    {
        $video = Video::create($request->validated());
        $video->category()->sync($request->input('category', []));
        foreach ($request->input('video_video', []) as $file) {
            $video->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('video_video');
        }

        return (new VideoResource($video))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Video $video)
    {
        abort_if(Gate::denies('video_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VideoResource($video->load(['project', 'post', 'category', 'team']));
    }

    public function update(UpdateVideoRequest $request, Video $video)
    {
        $video->update($request->validated());
        $video->category()->sync($request->input('category', []));
        if (count($video->video_video) > 0) {
            foreach ($video->video_video as $media) {
                if (! in_array($media->file_name, $request->input('video_video', []))) {
                    $media->delete();
                }
            }
        }
        $media = $video->video_video->pluck('file_name')->toArray();
        foreach ($request->input('video_video', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $video->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('video_video');
            }
        }

        return (new VideoResource($video))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Video $video)
    {
        abort_if(Gate::denies('video_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $video->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
