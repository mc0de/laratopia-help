@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.project.title_singular') }}:
                    {{ trans('cruds.project.fields.id') }}
                    {{ $project->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.project.fields.id') }}
                            </th>
                            <td>
                                {{ $project->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.project.fields.name') }}
                            </th>
                            <td>
                                {{ $project->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.project.fields.owner') }}
                            </th>
                            <td>
                                @if($project->owner)
                                    <span class="badge badge-relationship">{{ $project->owner->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.project.fields.created_at') }}
                            </th>
                            <td>
                                {{ $project->created_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.project.fields.package') }}
                            </th>
                            <td>
                                @foreach($project->package as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.project.fields.start_date') }}
                            </th>
                            <td>
                                {{ $project->start_date }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.project.fields.end_date') }}
                            </th>
                            <td>
                                {{ $project->end_date }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.project.fields.statues') }}
                            </th>
                            <td>
                                {{ $project->statues_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.project.fields.assignees') }}
                            </th>
                            <td>
                                @foreach($project->assignees as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->email }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.project.fields.updated_at') }}
                            </th>
                            <td>
                                {{ $project->updated_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.project.fields.deleted_at') }}
                            </th>
                            <td>
                                {{ $project->deleted_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.project.fields.team') }}
                            </th>
                            <td>
                                @if($project->team)
                                    <span class="badge badge-relationship">{{ $project->team->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('project_edit')
                    <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
