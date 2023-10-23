@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.videocategory.title_singular') }}:
                    {{ trans('cruds.videocategory.fields.id') }}
                    {{ $videocategory->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('videocategory.edit', [$videocategory])
        </div>
    </div>
</div>
@endsection