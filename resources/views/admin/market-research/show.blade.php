@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.marketResearch.title_singular') }}:
                    {{ trans('cruds.marketResearch.fields.id') }}
                    {{ $marketResearch->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.marketResearch.fields.id') }}
                            </th>
                            <td>
                                {{ $marketResearch->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.marketResearch.fields.title') }}
                            </th>
                            <td>
                                {{ $marketResearch->title }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.marketResearch.fields.details') }}
                            </th>
                            <td>
                                {{ $marketResearch->details }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.marketResearch.fields.created_at') }}
                            </th>
                            <td>
                                {{ $marketResearch->created_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.marketResearch.fields.updated_at') }}
                            </th>
                            <td>
                                {{ $marketResearch->updated_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.marketResearch.fields.deleted_at') }}
                            </th>
                            <td>
                                {{ $marketResearch->deleted_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.marketResearch.fields.team') }}
                            </th>
                            <td>
                                @if($marketResearch->team)
                                    <span class="badge badge-relationship">{{ $marketResearch->team->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('market_research_edit')
                    <a href="{{ route('admin.market-researchs.edit', $marketResearch) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.market-researchs.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection