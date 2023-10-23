@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.ad.title_singular') }}:
                    {{ trans('cruds.ad.fields.id') }}
                    {{ $ad->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('ad.edit', [$ad])
        </div>
    </div>
</div>
@endsection