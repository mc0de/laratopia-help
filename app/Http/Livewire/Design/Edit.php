<?php

namespace App\Http\Livewire\Design;

use App\Models\Design;
use App\Models\Post;
use App\Models\Project;
use App\Models\Team;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Edit extends Component
{
    public Design $design;

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

    public function getMediaCollection($name)
    {
        return $this->mediaCollections[$name];
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
                ->update(['model_id' => $this->design->id]));

        Media::whereIn('uuid', $this->mediaToRemove)->delete();
    }

    public function mount(Design $design)
    {
        $this->design = $design;
        $this->initListsForFields();
        $this->mediaCollections = [

            'design_design' => $design->design,

        ];
    }

    public function render()
    {
        return view('livewire.design.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->design->save();
        $this->syncMedia();

        return redirect()->route('admin.designs.index');
    }

    protected function rules(): array
    {
        return [
            'design.project_id' => [
                'integer',
                'exists:projects,id',
                'nullable',
            ],
            'design.post_id' => [
                'integer',
                'exists:posts,id',
                'nullable',
            ],
            'mediaCollections.design_design' => [
                'array',
                'required',
            ],
            'mediaCollections.design_design.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'design.statues' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['statues'])),
            ],
            'design.confirmation' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['confirmation'])),
            ],
            'design.note' => [
                'string',
                'nullable',
            ],
            'design.review' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['review'])),
            ],
            'design.team_id' => [
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
        $this->listsForFields['statues']      = $this->design::STATUES_RADIO;
        $this->listsForFields['confirmation'] = $this->design::CONFIRMATION_RADIO;
        $this->listsForFields['review']       = $this->design::REVIEW_RADIO;
        $this->listsForFields['team']         = Team::pluck('name', 'id')->toArray();
    }
}
