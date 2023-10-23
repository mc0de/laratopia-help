<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\Videocategory;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VideocategoryController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('videocategory_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.videocategory.index');
    }

    public function create()
    {
        abort_if(Gate::denies('videocategory_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.videocategory.create');
    }

    public function edit(Videocategory $videocategory)
    {
        abort_if(Gate::denies('videocategory_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.videocategory.edit', compact('videocategory'));
    }

    public function show(Videocategory $videocategory)
    {
        abort_if(Gate::denies('videocategory_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.videocategory.show', compact('videocategory'));
    }

    public function __construct()
    {
        $this->csvImportModel = Videocategory::class;
    }
}
