<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('design_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Design" format="csv" />
                <livewire:excel-export model="Design" format="xlsx" />
                <livewire:excel-export model="Design" format="pdf" />
            @endif


            @can('design_create')
                <x-csv-import route="{{ route('admin.designs.csv.store') }}" />
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
                            {{ trans('cruds.design.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.design.fields.project') }}
                            @include('components.table.sort', ['field' => 'project.name'])
                        </th>
                        <th>
                            {{ trans('cruds.design.fields.post') }}
                            @include('components.table.sort', ['field' => 'post.title'])
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.title') }}
                            @include('components.table.sort', ['field' => 'post.title'])
                        </th>
                        <th>
                            {{ trans('cruds.design.fields.design') }}
                        </th>
                        <th>
                            {{ trans('cruds.design.fields.created_at') }}
                            @include('components.table.sort', ['field' => 'created_at'])
                        </th>
                        <th>
                            {{ trans('cruds.design.fields.statues') }}
                            @include('components.table.sort', ['field' => 'statues'])
                        </th>
                        <th>
                            {{ trans('cruds.design.fields.confirmation') }}
                            @include('components.table.sort', ['field' => 'confirmation'])
                        </th>
                        <th>
                            {{ trans('cruds.design.fields.note') }}
                            @include('components.table.sort', ['field' => 'note'])
                        </th>
                        <th>
                            {{ trans('cruds.design.fields.review') }}
                            @include('components.table.sort', ['field' => 'review'])
                        </th>
                        <th>
                            {{ trans('cruds.design.fields.updated_at') }}
                            @include('components.table.sort', ['field' => 'updated_at'])
                        </th>
                        <th>
                            {{ trans('cruds.design.fields.deleted_at') }}
                            @include('components.table.sort', ['field' => 'deleted_at'])
                        </th>
                        <th>
                            {{ trans('cruds.design.fields.team') }}
                            @include('components.table.sort', ['field' => 'team.name'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($designs as $design)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $design->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $design->id }}
                            </td>
                            <td>
                                @if($design->project)
                                    <span class="badge badge-relationship">{{ $design->project->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($design->post)
                                    <span class="badge badge-relationship">{{ $design->post->title ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($design->post)
                                    {{ $design->post->title ?? '' }}
                                @endif
                            </td>
                            <td>
                                @foreach($design->design as $key => $entry)
                                    <a class="link-photo" href="{{ $entry['url'] }}">
                                        <img src="{{ $entry['thumbnail'] }}" alt="{{ $entry['name'] }}" title="{{ $entry['name'] }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $design->created_at }}
                            </td>
                            <td>
                                {{ $design->statues_label }}
                            </td>
                            <td>
                                {{ $design->confirmation_label }}
                            </td>
                            <td>
                                {{ $design->note }}
                            </td>
                            <td>
                                {{ $design->review_label }}
                            </td>
                            <td>
                                {{ $design->updated_at }}
                            </td>
                            <td>
                                {{ $design->deleted_at }}
                            </td>
                            <td>
                                @if($design->team)
                                    <span class="badge badge-relationship">{{ $design->team->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('design_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.designs.show', $design) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('design_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.designs.edit', $design) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('design_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $design->id }})" wire:loading.attr="disabled">
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
            {{ $designs->links() }}
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