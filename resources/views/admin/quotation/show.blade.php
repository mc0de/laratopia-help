@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.quotation.title_singular') }}:
                    {{ trans('cruds.quotation.fields.id') }}
                    {{ $quotation->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.quotation.fields.id') }}
                            </th>
                            <td>
                                {{ $quotation->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.quotation.fields.title') }}
                            </th>
                            <td>
                                {{ $quotation->title }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.quotation.fields.details') }}
                            </th>
                            <td>
                                {{ $quotation->details }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.quotation.fields.created_at') }}
                            </th>
                            <td>
                                {{ $quotation->created_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.quotation.fields.updated_at') }}
                            </th>
                            <td>
                                {{ $quotation->updated_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.quotation.fields.deleted_at') }}
                            </th>
                            <td>
                                {{ $quotation->deleted_at }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('quotation_edit')
                    <a href="{{ route('admin.quotations.edit', $quotation) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.quotations.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection