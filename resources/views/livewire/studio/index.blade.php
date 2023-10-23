<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('studio_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Studio" format="csv" />
                <livewire:excel-export model="Studio" format="xlsx" />
                <livewire:excel-export model="Studio" format="pdf" />
            @endif


            @can('studio_create')
                <x-csv-import route="{{ route('admin.studios.csv.store') }}" />
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
                            {{ trans('cruds.studio.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.studio.fields.title') }}
                            @include('components.table.sort', ['field' => 'title'])
                        </th>
                        <th>
                            {{ trans('cruds.studio.fields.description') }}
                            @include('components.table.sort', ['field' => 'description'])
                        </th>
                        <th>
                            {{ trans('cruds.studio.fields.date') }}
                            @include('components.table.sort', ['field' => 'date'])
                        </th>
                        <th>
                            {{ trans('cruds.studio.fields.time') }}
                            @include('components.table.sort', ['field' => 'time'])
                        </th>
                        <th>
                            {{ trans('cruds.studio.fields.status') }}
                            @include('components.table.sort', ['field' => 'status'])
                        </th>
                        <th>
                            {{ trans('cruds.studio.fields.created_at') }}
                            @include('components.table.sort', ['field' => 'created_at'])
                        </th>
                        <th>
                            {{ trans('cruds.studio.fields.updated_at') }}
                            @include('components.table.sort', ['field' => 'updated_at'])
                        </th>
                        <th>
                            {{ trans('cruds.studio.fields.deleted_at') }}
                            @include('components.table.sort', ['field' => 'deleted_at'])
                        </th>
                        <th>
                            {{ trans('cruds.studio.fields.team') }}
                            @include('components.table.sort', ['field' => 'team.name'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($studios as $studio)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $studio->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $studio->id }}
                            </td>
                            <td>
                                {{ $studio->title }}
                            </td>
                            <td>
                                {{ $studio->description }}
                            </td>
                            <td>
                                {{ $studio->date }}
                            </td>
                            <td>
                                {{ $studio->time }}
                            </td>
                            <td>
                                {{ $studio->status }}
                            </td>
                            <td>
                                {{ $studio->created_at }}
                            </td>
                            <td>
                                {{ $studio->updated_at }}
                            </td>
                            <td>
                                {{ $studio->deleted_at }}
                            </td>
                            <td>
                                @if($studio->team)
                                    <span class="badge badge-relationship">{{ $studio->team->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('studio_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.studios.show', $studio) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('studio_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.studios.edit', $studio) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('studio_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $studio->id }})" wire:loading.attr="disabled">
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
            {{ $studios->links() }}
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