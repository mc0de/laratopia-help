<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\MarketResearch;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MarketResearchController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('market_research_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.market-research.index');
    }

    public function create()
    {
        abort_if(Gate::denies('market_research_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.market-research.create');
    }

    public function edit(MarketResearch $marketResearch)
    {
        abort_if(Gate::denies('market_research_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.market-research.edit', compact('marketResearch'));
    }

    public function show(MarketResearch $marketResearch)
    {
        abort_if(Gate::denies('market_research_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marketResearch->load('team');

        return view('admin.market-research.show', compact('marketResearch'));
    }

    public function __construct()
    {
        $this->csvImportModel = MarketResearch::class;
    }
}
