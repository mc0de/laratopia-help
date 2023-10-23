<?php

namespace App\Http\Livewire\Ad;

use App\Models\Ad;
use App\Models\Adcategory;
use App\Models\Project;
use App\Models\Team;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Edit extends Component
{
    public Ad $ad;

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

    public function getMediaCollection($name)
    {
        return $this->mediaCollections[$name];
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
                ->update(['model_id' => $this->ad->id]));

        Media::whereIn('uuid', $this->mediaToRemove)->delete();
    }

    public function mount(Ad $ad)
    {
        $this->ad       = $ad;
        $this->category = $this->ad->category()->pluck('id')->toArray();
        $this->initListsForFields();
        $this->mediaCollections = [

            'ad_file' => $ad->file,

        ];
    }

    public function render()
    {
        return view('livewire.ad.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->ad->save();
        $this->ad->category()->sync($this->category);
        $this->syncMedia();

        return redirect()->route('admin.ads.index');
    }

    protected function rules(): array
    {
        return [
            'ad.project_id' => [
                'integer',
                'exists:projects,id',
                'required',
            ],
            'ad.title' => [
                'string',
                'nullable',
            ],
            'ad.content' => [
                'string',
                'nullable',
            ],
            'category' => [
                'array',
            ],
            'category.*.id' => [
                'integer',
                'exists:adcategories,id',
            ],
            'mediaCollections.ad_file' => [
                'array',
                'nullable',
            ],
            'mediaCollections.ad_file.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'ad.statues' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['statues'])),
            ],
            'ad.team_id' => [
                'integer',
                'exists:teams,id',
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['project']  = Project::pluck('name', 'id')->toArray();
        $this->listsForFields['category'] = Adcategory::pluck('name', 'id')->toArray();
        $this->listsForFields['statues']  = $this->ad::STATUES_RADIO;
        $this->listsForFields['team']     = Team::pluck('name', 'id')->toArray();
    }
}
