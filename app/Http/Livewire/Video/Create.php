<?php

namespace App\Http\Livewire\Video;

use App\Models\Post;
use App\Models\Project;
use App\Models\Team;
use App\Models\Video;
use App\Models\Videocategory;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Create extends Component
{
    public Video $video;

    public array $category = [];

    public array $mediaToRemove = [];

    public array $listsForFields = [];

    public array $mediaCollections = [];

    public function addMedia($media): void
    {
        $this->mediaCollections[$media['collection_name']][] = $media;
    }

    public function removeMedia($media): void
    {
        $collection = collect($this->mediaCollections[$media['collection_name']]);

        $this->mediaCollections[$media['collection_name']] = $collection->reject(fn ($item) => $item['uuid'] === $media['uuid'])->toArray();

        $this->mediaToRemove[] = $media['uuid'];
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
                ->update(['model_id' => $this->video->id]));

        Media::whereIn('uuid', $this->mediaToRemove)->delete();
    }

    public function mount(Video $video)
    {
        $this->video = $video;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.video.create');
    }

    public function submit()
    {
        $this->validate();

        $this->video->save();
        $this->video->category()->sync($this->category);
        $this->syncMedia();

        return redirect()->route('admin.videos.index');
    }

    protected function rules(): array
    {
        return [
            'video.project_id' => [
                'integer',
                'exists:projects,id',
                'nullable',
            ],
            'video.post_id' => [
                'integer',
                'exists:posts,id',
                'nullable',
            ],
            'mediaCollections.video_video' => [
                'array',
                'required',
            ],
            'mediaCollections.video_video.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'category' => [
                'array',
            ],
            'category.*.id' => [
                'integer',
                'exists:videocategories,id',
            ],
            'video.status' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['status'])),
            ],
            'video.confirmation' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['confirmation'])),
            ],
            'video.notes' => [
                'string',
                'nullable',
            ],
            'video.review' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['review'])),
            ],
            'video.team_id' => [
                'integer',
                'exists:teams,id',
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['project']      = Project::pluck('name', 'id')->toArray();
        $this->listsForFields['post']         = Post::pluck('title', 'id')->toArray();
        $this->listsForFields['category']     = Videocategory::pluck('name', 'id')->toArray();
        $this->listsForFields['status']       = $this->video::STATUS_RADIO;
        $this->listsForFields['confirmation'] = $this->video::CONFIRMATION_RADIO;
        $this->listsForFields['review']       = $this->video::REVIEW_RADIO;
        $this->listsForFields['team']         = Team::pluck('name', 'id')->toArray();
    }
}
