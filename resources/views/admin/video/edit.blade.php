@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.video.title_singular') }}:
                    {{ trans('cruds.video.fields.id') }}
                    {{ $video->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('video.edit', [$video])
        </div>
    </div>
</div>
@endsection