@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.motion.title_singular') }}:
                    {{ trans('cruds.motion.fields.id') }}
                    {{ $motion->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.motion.fields.id') }}
                            </th>
                            <td>
                                {{ $motion->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.motion.fields.title') }}
                            </th>
                            <td>
                                {{ $motion->title }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.motion.fields.details') }}
                            </th>
                            <td>
                                {{ $motion->details }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.motion.fields.minuts') }}
                            </th>
                            <td>
                                {{ $motion->minuts }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.motion.fields.created_at') }}
                            </th>
                            <td>
                                {{ $motion->created_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.motion.fields.updated_at') }}
                            </th>
                            <td>
                                {{ $motion->updated_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.motion.fields.deleted_at') }}
                            </th>
                            <td>
                                {{ $motion->deleted_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.motion.fields.team') }}
                            </th>
                            <td>
                                @if($motion->team)
                                    <span class="badge badge-relationship">{{ $motion->team->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('motion_edit')
                    <a href="{{ route('admin.motions.edit', $motion) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.motions.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection