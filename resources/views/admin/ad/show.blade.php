@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.ad.title_singular') }}:
                    {{ trans('cruds.ad.fields.id') }}
                    {{ $ad->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.ad.fields.id') }}
                            </th>
                            <td>
                                {{ $ad->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.ad.fields.project') }}
                            </th>
                            <td>
                                @if($ad->project)
                                    <span class="badge badge-relationship">{{ $ad->project->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.ad.fields.title') }}
                            </th>
                            <td>
                                {{ $ad->title }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.ad.fields.content') }}
                            </th>
                            <td>
                                {{ $ad->content }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.ad.fields.created_at') }}
                            </th>
                            <td>
                                {{ $ad->created_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.ad.fields.category') }}
                            </th>
                            <td>
                                @foreach($ad->category as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.ad.fields.file') }}
                            </th>
                            <td>
                                @foreach($ad->file as $key => $entry)
                                    <a class="link-light-blue" href="{{ $entry['url'] }}">
                                        <i class="far fa-file">
                                        </i>
                                        {{ $entry['file_name'] }}
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.ad.fields.statues') }}
                            </th>
                            <td>
                                {{ $ad->statues_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.ad.fields.updated_at') }}
                            </th>
                            <td>
                                {{ $ad->updated_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.ad.fields.deleted_at') }}
                            </th>
                            <td>
                                {{ $ad->deleted_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.ad.fields.team') }}
                            </th>
                            <td>
                                @if($ad->team)
                                    <span class="badge badge-relationship">{{ $ad->team->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('ad_edit')
                    <a href="{{ route('admin.ads.edit', $ad) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.ads.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection