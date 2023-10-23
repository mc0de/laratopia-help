<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('package_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Package" format="csv" />
                <livewire:excel-export model="Package" format="xlsx" />
                <livewire:excel-export model="Package" format="pdf" />
            @endif


            @can('package_create')
                <x-csv-import route="{{ route('admin.packages.csv.store') }}" />
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
                            {{ trans('cruds.package.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.package.fields.name') }}
                            @include('components.table.sort', ['field' => 'name'])
                        </th>
                        <th>
                            {{ trans('cruds.package.fields.ads') }}
                            @include('components.table.sort', ['field' => 'ads'])
                        </th>
                        <th>
                            {{ trans('cruds.package.fields.post') }}
                            @include('components.table.sort', ['field' => 'post'])
                        </th>
                        <th>
                            {{ trans('cruds.package.fields.design') }}
                            @include('components.table.sort', ['field' => 'design'])
                        </th>
                        <th>
                            {{ trans('cruds.package.fields.video') }}
                            @include('components.table.sort', ['field' => 'video'])
                        </th>
                        <th>
                            {{ trans('cruds.package.fields.platforms') }}
                            @include('components.table.sort', ['field' => 'platforms'])
                        </th>
                        <th>
                            {{ trans('cruds.package.fields.story') }}
                            @include('components.table.sort', ['field' => 'story'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($packages as $package)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $package->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $package->id }}
                            </td>
                            <td>
                                {{ $package->name }}
                            </td>
                            <td>
                                {{ $package->ads }}
                            </td>
                            <td>
                                {{ $package->post }}
                            </td>
                            <td>
                                {{ $package->design }}
                            </td>
                            <td>
                                {{ $package->video }}
                            </td>
                            <td>
                                {{ $package->platforms }}
                            </td>
                            <td>
                                {{ $package->story }}
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('package_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.packages.show', $package) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('package_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.packages.edit', $package) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('package_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $package->id }})" wire:loading.attr="disabled">
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
            {{ $packages->links() }}
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