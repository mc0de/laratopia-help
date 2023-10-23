<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('ad_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Ad" format="csv" />
                <livewire:excel-export model="Ad" format="xlsx" />
                <livewire:excel-export model="Ad" format="pdf" />
            @endif


            @can('ad_create')
                <x-csv-import route="{{ route('admin.ads.csv.store') }}" />
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
                            {{ trans('cruds.ad.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.ad.fields.project') }}
                            @include('components.table.sort', ['field' => 'project.name'])
                        </th>
                        <th>
                            {{ trans('cruds.ad.fields.title') }}
                            @include('components.table.sort', ['field' => 'title'])
                        </th>
                        <th>
                            {{ trans('cruds.ad.fields.content') }}
                            @include('components.table.sort', ['field' => 'content'])
                        </th>
                        <th>
                            {{ trans('cruds.ad.fields.created_at') }}
                            @include('components.table.sort', ['field' => 'created_at'])
                        </th>
                        <th>
                            {{ trans('cruds.ad.fields.category') }}
                        </th>
                        <th>
                            {{ trans('cruds.ad.fields.file') }}
                        </th>
                        <th>
                            {{ trans('cruds.ad.fields.statues') }}
                            @include('components.table.sort', ['field' => 'statues'])
                        </th>
                        <th>
                            {{ trans('cruds.ad.fields.updated_at') }}
                            @include('components.table.sort', ['field' => 'updated_at'])
                        </th>
                        <th>
                            {{ trans('cruds.ad.fields.deleted_at') }}
                            @include('components.table.sort', ['field' => 'deleted_at'])
                        </th>
                        <th>
                            {{ trans('cruds.ad.fields.team') }}
                            @include('components.table.sort', ['field' => 'team.name'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ads as $ad)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $ad->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $ad->id }}
                            </td>
                            <td>
                                @if($ad->project)
                                    <span class="badge badge-relationship">{{ $ad->project->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $ad->title }}
                            </td>
                            <td>
                                {{ $ad->content }}
                            </td>
                            <td>
                                {{ $ad->created_at }}
                            </td>
                            <td>
                                @foreach($ad->category as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($ad->file as $key => $entry)
                                    <a class="link-light-blue" href="{{ $entry['url'] }}">
                                        <i class="far fa-file">
                                        </i>
                                        {{ $entry['file_name'] }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $ad->statues_label }}
                            </td>
                            <td>
                                {{ $ad->updated_at }}
                            </td>
                            <td>
                                {{ $ad->deleted_at }}
                            </td>
                            <td>
                                @if($ad->team)
                                    <span class="badge badge-relationship">{{ $ad->team->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('ad_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.ads.show', $ad) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('ad_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.ads.edit', $ad) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('ad_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $ad->id }})" wire:loading.attr="disabled">
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
            {{ $ads->links() }}
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