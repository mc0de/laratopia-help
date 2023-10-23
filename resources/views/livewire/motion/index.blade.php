<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('motion_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Motion" format="csv" />
                <livewire:excel-export model="Motion" format="xlsx" />
                <livewire:excel-export model="Motion" format="pdf" />
            @endif


            @can('motion_create')
                <x-csv-import route="{{ route('admin.motions.csv.store') }}" />
            @endcan

        </div>
        <div class="w-full sm:w-1/2 sm:text-right">
            Search:
            <input type="text" wire:model.debounce.300ms="search" class="w-full sm:w-1/3 inline-block" />
        </div>
    </div>
    <div wire:loading.delay>
        Loading...
    </div>

    <div class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table table-index w-full">
                <thead>
                    <tr>
                        <th class="w-9">
                        </th>
                        <th class="w-28">
                            {{ trans('cruds.motion.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.motion.fields.title') }}
                            @include('components.table.sort', ['field' => 'title'])
                        </th>
                        <th>
                            {{ trans('cruds.motion.fields.details') }}
                            @include('components.table.sort', ['field' => 'details'])
                        </th>
                        <th>
                            {{ trans('cruds.motion.fields.minuts') }}
                            @include('components.table.sort', ['field' => 'minuts'])
                        </th>
                        <th>
                            {{ trans('cruds.motion.fields.created_at') }}
                            @include('components.table.sort', ['field' => 'created_at'])
                        </th>
                        <th>
                            {{ trans('cruds.motion.fields.updated_at') }}
                            @include('components.table.sort', ['field' => 'updated_at'])
                        </th>
                        <th>
                            {{ trans('cruds.motion.fields.deleted_at') }}
                            @include('components.table.sort', ['field' => 'deleted_at'])
                        </th>
                        <th>
                            {{ trans('cruds.motion.fields.team') }}
                            @include('components.table.sort', ['field' => 'team.name'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($motions as $motion)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $motion->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $motion->id }}
                            </td>
                            <td>
                                {{ $motion->title }}
                            </td>
                            <td>
                                {{ $motion->details }}
                            </td>
                            <td>
                                {{ $motion->minuts }}
                            </td>
                            <td>
                                {{ $motion->created_at }}
                            </td>
                            <td>
                                {{ $motion->updated_at }}
                            </td>
                            <td>
                                {{ $motion->deleted_at }}
                            </td>
                            <td>
                                @if($motion->team)
                                    <span class="badge badge-relationship">{{ $motion->team->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('motion_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.motions.show', $motion) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('motion_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.motions.edit', $motion) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('motion_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $motion->id }})" wire:loading.attr="disabled">
                                            {{ trans('global.delete') }}
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10">No entries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-body">
        <div class="pt-3">
            @if($this->selectedCount)
                <p class="text-sm leading-5">
                    <span class="font-medium">
                        {{ $this->selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
            {{ $motions->links() }}
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('confirm', e => {
    if (!confirm("{{ trans('global.areYouSure') }}")) {
        return
    }
@this[e.callback](...e.argv)
})
    </script>
@endpush