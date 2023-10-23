<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\Postcategory;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostcategoryController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('postcategory_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.postcategory.index');
    }

    public function create()
    {
        abort_if(Gate::denies('postcategory_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.postcategory.create');
    }

    public function edit(Postcategory $postcategory)
    {
        abort_if(Gate::denies('postcategory_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.postcategory.edit', compact('postcategory'));
    }

    public function show(Postcategory $postcategory)
    {
        abort_if(Gate::denies('postcategory_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.postcategory.show', compact('postcategory'));
    }

    public function __construct()
    {
        $this->csvImportModel = Postcategory::class;
    }
}
