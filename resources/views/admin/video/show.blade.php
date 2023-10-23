@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.video.title_singular') }}:
                    {{ trans('cruds.video.fields.id') }}
                    {{ $video->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.video.fields.id') }}
                            </th>
                            <td>
                                {{ $video->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.video.fields.project') }}
                            </th>
                            <td>
                                @if($video->project)
                                    <span class="badge badge-relationship">{{ $video->project->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.video.fields.post') }}
                            </th>
                            <td>
                                @if($video->post)
                                    <span class="badge badge-relationship">{{ $video->post->title ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.video.fields.video') }}
                            </th>
                            <td>
                                @foreach($video->video as $key => $entry)
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
                                {{ trans('cruds.video.fields.created_at') }}
                            </th>
                            <td>
                                {{ $video->created_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.video.fields.category') }}
                            </th>
                            <td>
                                @foreach($video->category as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.video.fields.status') }}
                            </th>
                            <td>
                                {{ $video->status_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.video.fields.confirmation') }}
                            </th>
                            <td>
                                {{ $video->confirmation_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.video.fields.notes') }}
                            </th>
                            <td>
                                {{ $video->notes }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.video.fields.review') }}
                            </th>
                            <td>
                                {{ $video->review_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.video.fields.updated_at') }}
                            </th>
                            <td>
                                {{ $video->updated_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.video.fields.deleted_at') }}
                            </th>
                            <td>
                                {{ $video->deleted_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.video.fields.team') }}
                            </th>
                            <td>
                                @if($video->team)
                                    <span class="badge badge-relationship">{{ $video->team->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('video_edit')
                    <a href="{{ route('admin.videos.edit', $video) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.videos.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection