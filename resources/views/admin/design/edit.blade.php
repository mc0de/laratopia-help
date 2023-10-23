@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.design.title_singular') }}:
                    {{ trans('cruds.design.fields.id') }}
                    {{ $design->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('design.edit', [$design])
        </div>
    </div>
</div>
@endsection