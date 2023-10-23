<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWebsiteRequest;
use App\Http\Requests\UpdateWebsiteRequest;
use App\Http\Resources\Admin\WebsiteResource;
use App\Models\Website;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WebsiteApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('website_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WebsiteResource(Website::with(['team'])->get());
    }

    public function store(StoreWebsiteRequest $request)
    {
        $website = Website::create($request->validated());

        return (new WebsiteResource($website))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Website $website)
    {
        abort_if(Gate::denies('website_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WebsiteResource($website->load(['team']));
    }

    public function update(UpdateWebsiteRequest $request, Website $website)
    {
        $website->update($request->validated());

        return (new WebsiteResource($website))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Website $website)
    {
        abort_if(Gate::denies('website_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $website->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
