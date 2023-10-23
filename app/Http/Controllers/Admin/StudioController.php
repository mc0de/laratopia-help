<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\Studio;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudioController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('studio_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.studio.index');
    }

    public function create()
    {
        abort_if(Gate::denies('studio_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.studio.create');
    }

    public function edit(Studio $studio)
    {
        abort_if(Gate::denies('studio_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.studio.edit', compact('studio'));
    }

    public function show(Studio $studio)
    {
        abort_if(Gate::denies('studio_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studio->load('team');

        return view('admin.studio.show', compact('studio'));
    }

    public function __construct()
    {
        $this->csvImportModel = Studio::class;
    }
}
