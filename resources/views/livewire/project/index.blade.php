<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('project_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Project" format="csv" />
                <livewire:excel-export model="Project" format="xlsx" />
                <livewire:excel-export model="Project" format="pdf" />
            @endif


            @can('project_create')
                <x-csv-import route="{{ route('admin.projects.csv.store') }}" />
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
                            {{ trans('cruds.project.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.project.fields.name') }}
                            @include('components.table.sort', ['field' => 'name'])
                        </th>
                        <th>
                            {{ trans('cruds.project.fields.owner') }}
                            @include('components.table.sort', ['field' => 'owner.name'])
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                            @include('components.table.sort', ['field' => 'owner.name'])
                        </th>
                        <th>
                            {{ trans('cruds.project.fields.created_at') }}
                            @include('components.table.sort', ['field' => 'created_at'])
                        </th>
                        <th>
                            {{ trans('cruds.project.fields.package') }}
                        </th>
                        <th>
                            {{ trans('cruds.project.fields.start_date') }}
                            @include('components.table.sort', ['field' => 'start_date'])
                        </th>
                        <th>
                            {{ trans('cruds.project.fields.end_date') }}
                            @include('components.table.sort', ['field' => 'end_date'])
                        </th>
                        <th>
                            {{ trans('cruds.project.fields.statues') }}
                            @include('components.table.sort', ['field' => 'statues'])
                        </th>
                        <th>
                            {{ trans('cruds.project.fields.assignees') }}
                        </th>
                        <th>
                            {{ trans('cruds.project.fields.updated_at') }}
                            @include('components.table.sort', ['field' => 'updated_at'])
                        </th>
                        <th>
                            {{ trans('cruds.project.fields.deleted_at') }}
                            @include('components.table.sort', ['field' => 'deleted_at'])
                        </th>
                        <th>
                            {{ trans('cruds.project.fields.team') }}
                            @include('components.table.sort', ['field' => 'team.name'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $project->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $project->id }}
                            </td>
                            <td>
                                {{ $project->name }}
                            </td>
                            <td>
                                @if($project->owner)
                                    <span class="badge badge-relationship">{{ $project->owner->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($project->owner)
                                    {{ $project->owner->name ?? '' }}
                                @endif
                            </td>
                            <td>
                                {{ $project->created_at }}
                            </td>
                            <td>
                                @foreach($project->package as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $project->start_date }}
                            </td>
                            <td>
                                {{ $project->end_date }}
                            </td>
                            <td>
                                {{ $project->statues_label }}
                            </td>
                            <td>
                                @foreach($project->assignees as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->email }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $project->updated_at }}
                            </td>
                            <td>
                                {{ $project->deleted_at }}
                            </td>
                            <td>
                                @if($project->team)
                                    <span class="badge badge-relationship">{{ $project->team->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('project_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.projects.show', $project) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('project_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.projects.edit', $project) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('project_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $project->id }})" wire:loading.attr="disabled">
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
            {{ $projects->links() }}
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
