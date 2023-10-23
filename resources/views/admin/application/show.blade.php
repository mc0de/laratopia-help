@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.application.title_singular') }}:
                    {{ trans('cruds.application.fields.id') }}
                    {{ $application->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.application.fields.id') }}
                            </th>
                            <td>
                                {{ $application->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.application.fields.title') }}
                            </th>
                            <td>
                                {{ $application->title }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.application.fields.details') }}
                            </th>
                            <td>
                                {{ $application->details }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.application.fields.created_at') }}
                            </th>
                            <td>
                                {{ $application->created_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.application.fields.updated_at') }}
                            </th>
                            <td>
                                {{ $application->updated_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.application.fields.deleted_at') }}
                            </th>
                            <td>
                                {{ $application->deleted_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.application.fields.team') }}
                            </th>
                            <td>
                                @if($application->team)
                                    <span class="badge badge-relationship">{{ $application->team->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('application_edit')
                    <a href="{{ route('admin.applications.edit', $application) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.applications.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection