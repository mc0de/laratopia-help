<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('video_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Video" format="csv" />
                <livewire:excel-export model="Video" format="xlsx" />
                <livewire:excel-export model="Video" format="pdf" />
            @endif


            @can('video_create')
                <x-csv-import route="{{ route('admin.videos.csv.store') }}" />
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
                            {{ trans('cruds.video.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.video.fields.project') }}
                            @include('components.table.sort', ['field' => 'project.name'])
                        </th>
                        <th>
                            {{ trans('cruds.video.fields.post') }}
                            @include('components.table.sort', ['field' => 'post.title'])
                        </th>
                        <th>
                            {{ trans('cruds.video.fields.video') }}
                        </th>
                        <th>
                            {{ trans('cruds.video.fields.created_at') }}
                            @include('components.table.sort', ['field' => 'created_at'])
                        </th>
                        <th>
                            {{ trans('cruds.video.fields.category') }}
                        </th>
                        <th>
                            {{ trans('cruds.video.fields.status') }}
                            @include('components.table.sort', ['field' => 'status'])
                        </th>
                        <th>
                            {{ trans('cruds.video.fields.confirmation') }}
                            @include('components.table.sort', ['field' => 'confirmation'])
                        </th>
                        <th>
                            {{ trans('cruds.video.fields.notes') }}
                            @include('components.table.sort', ['field' => 'notes'])
                        </th>
                        <th>
                            {{ trans('cruds.video.fields.review') }}
                            @include('components.table.sort', ['field' => 'review'])
                        </th>
                        <th>
                            {{ trans('cruds.video.fields.updated_at') }}
                            @include('components.table.sort', ['field' => 'updated_at'])
                        </th>
                        <th>
                            {{ trans('cruds.video.fields.deleted_at') }}
                            @include('components.table.sort', ['field' => 'deleted_at'])
                        </th>
                        <th>
                            {{ trans('cruds.video.fields.team') }}
                            @include('components.table.sort', ['field' => 'team.name'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($videos as $video)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $video->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $video->id }}
                            </td>
                            <td>
                                @if($video->project)
                                    <span class="badge badge-relationship">{{ $video->project->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($video->post)
                                    <span class="badge badge-relationship">{{ $video->post->title ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @foreach($video->video as $key => $entry)
                                    <a class="link-light-blue" href="{{ $entry['url'] }}">
                                        <i class="far fa-file">
                                        </i>
                                        {{ $entry['file_name'] }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $video->created_at }}
                            </td>
                            <td>
                                @foreach($video->category as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $video->status_label }}
                            </td>
                            <td>
                                {{ $video->confirmation_label }}
                            </td>
                            <td>
                                {{ $video->notes }}
                            </td>
                            <td>
                                {{ $video->review_label }}
                            </td>
                            <td>
                                {{ $video->updated_at }}
                            </td>
                            <td>
                                {{ $video->deleted_at }}
                            </td>
                            <td>
                                @if($video->team)
                                    <span class="badge badge-relationship">{{ $video->team->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('video_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.videos.show', $video) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('video_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.videos.edit', $video) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('video_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $video->id }})" wire:loading.attr="disabled">
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
            {{ $videos->links() }}
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