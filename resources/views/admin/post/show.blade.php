@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.post.title_singular') }}:
                    {{ trans('cruds.post.fields.id') }}
                    {{ $post->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.post.fields.id') }}
                            </th>
                            <td>
                                {{ $post->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.post.fields.project') }}
                            </th>
                            <td>
                                @if($post->project)
                                    <span class="badge badge-relationship">{{ $post->project->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.post.fields.title') }}
                            </th>
                            <td>
                                {{ $post->title }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.post.fields.content') }}
                            </th>
                            <td>
                                {{ $post->content }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.post.fields.created_at') }}
                            </th>
                            <td>
                                {{ $post->created_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.post.fields.category') }}
                            </th>
                            <td>
                                @foreach($post->category as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.post.fields.status') }}
                            </th>
                            <td>
                                {{ $post->status_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.post.fields.confirmation') }}
                            </th>
                            <td>
                                {{ $post->confirmation_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.post.fields.note') }}
                            </th>
                            <td>
                                {{ $post->note }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.post.fields.review') }}
                            </th>
                            <td>
                                {{ $post->review_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.post.fields.updated_at') }}
                            </th>
                            <td>
                                {{ $post->updated_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.post.fields.deleted_at') }}
                            </th>
                            <td>
                                {{ $post->deleted_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.post.fields.team') }}
                            </th>
                            <td>
                                @if($post->team)
                                    <span class="badge badge-relationship">{{ $post->team->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('post_edit')
                    <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection