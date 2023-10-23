<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\Motion;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MotionController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('motion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.motion.index');
    }

    public function create()
    {
        abort_if(Gate::denies('motion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.motion.create');
    }

    public function edit(Motion $motion)
    {
        abort_if(Gate::denies('motion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.motion.edit', compact('motion'));
    }

    public function show(Motion $motion)
    {
        abort_if(Gate::denies('motion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $motion->load('team');

        return view('admin.motion.show', compact('motion'));
    }

    public function __construct()
    {
        $this->csvImportModel = Motion::class;
    }
}
