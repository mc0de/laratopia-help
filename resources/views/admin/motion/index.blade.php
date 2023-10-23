@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-white">
        <div class="card-header border-b border-blueGray-200">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('cruds.motion.title_singular') }}
                    {{ trans('global.list') }}
                </h6>

                @can('motion_create')
                    <a class="btn btn-indigo" href="{{ route('admin.motions.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.motion.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        @livewire('motion.index')

    </div>
</div>
@endsection