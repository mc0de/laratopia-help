<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('website_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Website" format="csv" />
                <livewire:excel-export model="Website" format="xlsx" />
                <livewire:excel-export model="Website" format="pdf" />
            @endif


            @can('website_create')
                <x-csv-import route="{{ route('admin.websites.csv.store') }}" />
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
                            {{ trans('cruds.website.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.website.fields.title') }}
                            @include('components.table.sort', ['field' => 'title'])
                        </th>
                        <th>
                            {{ trans('cruds.website.fields.details') }}
                            @include('components.table.sort', ['field' => 'details'])
                        </th>
                        <th>
                            {{ trans('cruds.website.fields.created_at') }}
                            @include('components.table.sort', ['field' => 'created_at'])
                        </th>
                        <th>
                            {{ trans('cruds.website.fields.updated_at') }}
                            @include('components.table.sort', ['field' => 'updated_at'])
                        </th>
                        <th>
                            {{ trans('cruds.website.fields.deleted_at') }}
                            @include('components.table.sort', ['field' => 'deleted_at'])
                        </th>
                        <th>
                            {{ trans('cruds.website.fields.team') }}
                            @include('components.table.sort', ['field' => 'team.name'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($websites as $website)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $website->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $website->id }}
                            </td>
                            <td>
                                {{ $website->title }}
                            </td>
                            <td>
                                {{ $website->details }}
                            </td>
                            <td>
                                {{ $website->created_at }}
                            </td>
                            <td>
                                {{ $website->updated_at }}
                            </td>
                            <td>
                                {{ $website->deleted_at }}
                            </td>
                            <td>
                                @if($website->team)
                                    <span class="badge badge-relationship">{{ $website->team->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('website_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.websites.show', $website) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('website_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.websites.edit', $website) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('website_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $website->id }})" wire:loading.attr="disabled">
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
            {{ $websites->links() }}
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