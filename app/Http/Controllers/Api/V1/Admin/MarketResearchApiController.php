<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMarketResearchRequest;
use App\Http\Requests\UpdateMarketResearchRequest;
use App\Http\Resources\Admin\MarketResearchResource;
use App\Models\MarketResearch;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MarketResearchApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('market_research_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MarketResearchResource(MarketResearch::with(['team'])->get());
    }

    public function store(StoreMarketResearchRequest $request)
    {
        $marketResearch = MarketResearch::create($request->validated());

        return (new MarketResearchResource($marketResearch))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MarketResearch $marketResearch)
    {
        abort_if(Gate::denies('market_research_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MarketResearchResource($marketResearch->load(['team']));
    }

    public function update(UpdateMarketResearchRequest $request, MarketResearch $marketResearch)
    {
        $marketResearch->update($request->validated());

        return (new MarketResearchResource($marketResearch))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MarketResearch $marketResearch)
    {
        abort_if(Gate::denies('market_research_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marketResearch->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
