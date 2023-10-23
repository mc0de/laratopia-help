<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('system_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="System" format="csv" />
                <livewire:excel-export model="System" format="xlsx" />
                <livewire:excel-export model="System" format="pdf" />
            @endif


            @can('system_create')
                <x-csv-import route="{{ route('admin.systems.csv.store') }}" />
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
                            {{ trans('cruds.system.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.system.fields.title') }}
                            @include('components.table.sort', ['field' => 'title'])
                        </th>
                        <th>
                            {{ trans('cruds.system.fields.details') }}
                            @include('components.table.sort', ['field' => 'details'])
                        </th>
                        <th>
                            {{ trans('cruds.system.fields.created_at') }}
                            @include('components.table.sort', ['field' => 'created_at'])
                        </th>
                        <th>
                            {{ trans('cruds.system.fields.updated_at') }}
                            @include('components.table.sort', ['field' => 'updated_at'])
                        </th>
                        <th>
                            {{ trans('cruds.system.fields.deleted_at') }}
                            @include('components.table.sort', ['field' => 'deleted_at'])
                        </th>
                        <th>
                            {{ trans('cruds.system.fields.team') }}
                            @include('components.table.sort', ['field' => 'team.name'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($systems as $system)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $system->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $system->id }}
                            </td>
                            <td>
                                {{ $system->title }}
                            </td>
                            <td>
                                {{ $system->details }}
                            </td>
                            <td>
                                {{ $system->created_at }}
                            </td>
                            <td>
                                {{ $system->updated_at }}
                            </td>
                            <td>
                                {{ $system->deleted_at }}
                            </td>
                            <td>
                                @if($system->team)
                                    <span class="badge badge-relationship">{{ $system->team->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('system_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.systems.show', $system) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('system_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.systems.edit', $system) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('system_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $system->id }})" wire:loading.attr="disabled">
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
            {{ $systems->links() }}
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