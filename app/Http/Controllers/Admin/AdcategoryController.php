<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\Adcategory;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdcategoryController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('adcategory_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.adcategory.index');
    }

    public function create()
    {
        abort_if(Gate::denies('adcategory_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.adcategory.create');
    }

    public function edit(Adcategory $adcategory)
    {
        abort_if(Gate::denies('adcategory_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.adcategory.edit', compact('adcategory'));
    }

    public function show(Adcategory $adcategory)
    {
        abort_if(Gate::denies('adcategory_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.adcategory.show', compact('adcategory'));
    }

    public function __construct()
    {
        $this->csvImportModel = Adcategory::class;
    }
}
