<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\System;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SystemController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('system_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.system.index');
    }

    public function create()
    {
        abort_if(Gate::denies('system_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.system.create');
    }

    public function edit(System $system)
    {
        abort_if(Gate::denies('system_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.system.edit', compact('system'));
    }

    public function show(System $system)
    {
        abort_if(Gate::denies('system_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $system->load('team');

        return view('admin.system.show', compact('system'));
    }

    public function __construct()
    {
        $this->csvImportModel = System::class;
    }
}
