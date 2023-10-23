<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\Design;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DesignController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('design_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.design.index');
    }

    public function create()
    {
        abort_if(Gate::denies('design_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.design.create');
    }

    public function edit(Design $design)
    {
        abort_if(Gate::denies('design_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.design.edit', compact('design'));
    }

    public function show(Design $design)
    {
        abort_if(Gate::denies('design_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $design->load('project', 'post', 'team');

        return view('admin.design.show', compact('design'));
    }

    public function storeMedia(Request $request)
    {
        abort_if(Gate::none(['design_create', 'design_edit']), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->has('size')) {
            $this->validate($request, [
                'file' => 'max:' . $request->input('size') * 1024,
            ]);
        }
        if (request()->has('max_width') || request()->has('max_height')) {
            $this->validate(request(), [
                'file' => sprintf(
                    'image|dimensions:max_width=%s,max_height=%s',
                    request()->input('max_width', 100000),
                    request()->input('max_height', 100000)
                ),
            ]);
        }

        $model                     = new Design();
        $model->id                 = $request->input('model_id', 0);
        $model->exists             = true;
        $media                     = $model->addMediaFromRequest('file')->toMediaCollection($request->input('collection_name'));
        $media->wasRecentlyCreated = true;

        return response()->json(compact('media'), Response::HTTP_CREATED);
    }

    public function __construct()
    {
        $this->csvImportModel = Design::class;
    }
}
