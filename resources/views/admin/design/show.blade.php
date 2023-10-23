@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.design.title_singular') }}:
                    {{ trans('cruds.design.fields.id') }}
                    {{ $design->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.design.fields.id') }}
                            </th>
                            <td>
                                {{ $design->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.design.fields.project') }}
                            </th>
                            <td>
                                @if($design->project)
                                    <span class="badge badge-relationship">{{ $design->project->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.design.fields.post') }}
                            </th>
                            <td>
                                @if($design->post)
                                    <span class="badge badge-relationship">{{ $design->post->title ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.design.fields.design') }}
                            </th>
                            <td>
                                @foreach($design->design as $key => $entry)
                                    <a class="link-photo" href="{{ $entry['url'] }}">
                                        <img src="{{ $entry['preview_thumbnail'] }}" alt="{{ $entry['name'] }}" title="{{ $entry['name'] }}">
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.design.fields.created_at') }}
                            </th>
                            <td>
                                {{ $design->created_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.design.fields.statues') }}
                            </th>
                            <td>
                                {{ $design->statues_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.design.fields.confirmation') }}
                            </th>
                            <td>
                                {{ $design->confirmation_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.design.fields.note') }}
                            </th>
                            <td>
                                {{ $design->note }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.design.fields.review') }}
                            </th>
                            <td>
                                {{ $design->review_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.design.fields.updated_at') }}
                            </th>
                            <td>
                                {{ $design->updated_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.design.fields.deleted_at') }}
                            </th>
                            <td>
                                {{ $design->deleted_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.design.fields.team') }}
                            </th>
                            <td>
                                @if($design->team)
                                    <span class="badge badge-relationship">{{ $design->team->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('design_edit')
                    <a href="{{ route('admin.designs.edit', $design) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.designs.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection