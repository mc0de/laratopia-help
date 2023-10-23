<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('post_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Post" format="csv" />
                <livewire:excel-export model="Post" format="xlsx" />
                <livewire:excel-export model="Post" format="pdf" />
            @endif


            @can('post_create')
                <x-csv-import route="{{ route('admin.posts.csv.store') }}" />
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
                            {{ trans('cruds.post.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.project') }}
                            @include('components.table.sort', ['field' => 'project.name'])
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.title') }}
                            @include('components.table.sort', ['field' => 'title'])
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.content') }}
                            @include('components.table.sort', ['field' => 'content'])
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.created_at') }}
                            @include('components.table.sort', ['field' => 'created_at'])
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.category') }}
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.status') }}
                            @include('components.table.sort', ['field' => 'status'])
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.confirmation') }}
                            @include('components.table.sort', ['field' => 'confirmation'])
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.note') }}
                            @include('components.table.sort', ['field' => 'note'])
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.review') }}
                            @include('components.table.sort', ['field' => 'review'])
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.updated_at') }}
                            @include('components.table.sort', ['field' => 'updated_at'])
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.deleted_at') }}
                            @include('components.table.sort', ['field' => 'deleted_at'])
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.team') }}
                            @include('components.table.sort', ['field' => 'team.name'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $post->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $post->id }}
                            </td>
                            <td>
                                @if($post->project)
                                    <span class="badge badge-relationship">{{ $post->project->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $post->title }}
                            </td>
                            <td>
                                {{ $post->content }}
                            </td>
                            <td>
                                {{ $post->created_at }}
                            </td>
                            <td>
                                @foreach($post->category as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $post->status_label }}
                            </td>
                            <td>
                                {{ $post->confirmation_label }}
                            </td>
                            <td>
                                {{ $post->note }}
                            </td>
                            <td>
                                {{ $post->review_label }}
                            </td>
                            <td>
                                {{ $post->updated_at }}
                            </td>
                            <td>
                                {{ $post->deleted_at }}
                            </td>
                            <td>
                                @if($post->team)
                                    <span class="badge badge-relationship">{{ $post->team->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('post_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.posts.show', $post) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('post_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.posts.edit', $post) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('post_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $post->id }})" wire:loading.attr="disabled">
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
            {{ $posts->links() }}
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