<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\Website;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WebsiteController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('website_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.website.index');
    }

    public function create()
    {
        abort_if(Gate::denies('website_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.website.create');
    }

    public function edit(Website $website)
    {
        abort_if(Gate::denies('website_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.website.edit', compact('website'));
    }

    public function show(Website $website)
    {
        abort_if(Gate::denies('website_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $website->load('team');

        return view('admin.website.show', compact('website'));
    }

    public function __construct()
    {
        $this->csvImportModel = Website::class;
    }
}
