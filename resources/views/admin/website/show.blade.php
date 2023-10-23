@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.website.title_singular') }}:
                    {{ trans('cruds.website.fields.id') }}
                    {{ $website->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.website.fields.id') }}
                            </th>
                            <td>
                                {{ $website->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.website.fields.title') }}
                            </th>
                            <td>
                                {{ $website->title }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.website.fields.details') }}
                            </th>
                            <td>
                                {{ $website->details }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.website.fields.created_at') }}
                            </th>
                            <td>
                                {{ $website->created_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.website.fields.updated_at') }}
                            </th>
                            <td>
                                {{ $website->updated_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.website.fields.deleted_at') }}
                            </th>
                            <td>
                                {{ $website->deleted_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.website.fields.team') }}
                            </th>
                            <td>
                                @if($website->team)
                                    <span class="badge badge-relationship">{{ $website->team->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('website_edit')
                    <a href="{{ route('admin.websites.edit', $website) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.websites.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection