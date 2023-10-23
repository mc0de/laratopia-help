<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostcategoryRequest;
use App\Http\Requests\UpdatePostcategoryRequest;
use App\Http\Resources\Admin\PostcategoryResource;
use App\Models\Postcategory;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostcategoryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('postcategory_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PostcategoryResource(Postcategory::all());
    }

    public function store(StorePostcategoryRequest $request)
    {
        $postcategory = Postcategory::create($request->validated());

        return (new PostcategoryResource($postcategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Postcategory $postcategory)
    {
        abort_if(Gate::denies('postcategory_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PostcategoryResource($postcategory);
    }

    public function update(UpdatePostcategoryRequest $request, Postcategory $postcategory)
    {
        $postcategory->update($request->validated());

        return (new PostcategoryResource($postcategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Postcategory $postcategory)
    {
        abort_if(Gate::denies('postcategory_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $postcategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
