@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.studio.title_singular') }}:
                    {{ trans('cruds.studio.fields.id') }}
                    {{ $studio->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.studio.fields.id') }}
                            </th>
                            <td>
                                {{ $studio->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.studio.fields.title') }}
                            </th>
                            <td>
                                {{ $studio->title }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.studio.fields.description') }}
                            </th>
                            <td>
                                {{ $studio->description }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.studio.fields.date') }}
                            </th>
                            <td>
                                {{ $studio->date }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.studio.fields.time') }}
                            </th>
                            <td>
                                {{ $studio->time }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.studio.fields.status') }}
                            </th>
                            <td>
                                {{ $studio->status }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.studio.fields.created_at') }}
                            </th>
                            <td>
                                {{ $studio->created_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.studio.fields.updated_at') }}
                            </th>
                            <td>
                                {{ $studio->updated_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.studio.fields.deleted_at') }}
                            </th>
                            <td>
                                {{ $studio->deleted_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.studio.fields.team') }}
                            </th>
                            <td>
                                @if($studio->team)
                                    <span class="badge badge-relationship">{{ $studio->team->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('studio_edit')
                    <a href="{{ route('admin.studios.edit', $studio) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.studios.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection