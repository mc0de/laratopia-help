@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.system.title_singular') }}:
                    {{ trans('cruds.system.fields.id') }}
                    {{ $system->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.system.fields.id') }}
                            </th>
                            <td>
                                {{ $system->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.system.fields.title') }}
                            </th>
                            <td>
                                {{ $system->title }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.system.fields.details') }}
                            </th>
                            <td>
                                {{ $system->details }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.system.fields.created_at') }}
                            </th>
                            <td>
                                {{ $system->created_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.system.fields.updated_at') }}
                            </th>
                            <td>
                                {{ $system->updated_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.system.fields.deleted_at') }}
                            </th>
                            <td>
                                {{ $system->deleted_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.system.fields.team') }}
                            </th>
                            <td>
                                @if($system->team)
                                    <span class="badge badge-relationship">{{ $system->team->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('system_edit')
                    <a href="{{ route('admin.systems.edit', $system) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.systems.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection