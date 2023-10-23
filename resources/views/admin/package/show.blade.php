@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.package.title_singular') }}:
                    {{ trans('cruds.package.fields.id') }}
                    {{ $package->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.package.fields.id') }}
                            </th>
                            <td>
                                {{ $package->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.package.fields.name') }}
                            </th>
                            <td>
                                {{ $package->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.package.fields.ads') }}
                            </th>
                            <td>
                                {{ $package->ads }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.package.fields.post') }}
                            </th>
                            <td>
                                {{ $package->post }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.package.fields.design') }}
                            </th>
                            <td>
                                {{ $package->design }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.package.fields.video') }}
                            </th>
                            <td>
                                {{ $package->video }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.package.fields.platforms') }}
                            </th>
                            <td>
                                {{ $package->platforms }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.package.fields.story') }}
                            </th>
                            <td>
                                {{ $package->story }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('package_edit')
                    <a href="{{ route('admin.packages.edit', $package) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection