@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.postcategory.title_singular') }}:
                    {{ trans('cruds.postcategory.fields.id') }}
                    {{ $postcategory->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('postcategory.edit', [$postcategory])
        </div>
    </div>
</div>
@endsection