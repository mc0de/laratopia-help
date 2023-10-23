<?php

namespace App\Http\Livewire\Website;

use App\Models\Team;
use App\Models\Website;
use Livewire\Component;

class Create extends Component
{
    public Website $website;

    public array $listsForFields = [];

    public function mount(Website $website)
    {
        $this->website = $website;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.website.create');
    }

    public function submit()
    {
        $this->validate();

        $this->website->save();

        return redirect()->route('admin.websites.index');
    }

    protected function rules(): array
    {
        return [
            'website.title' => [
                'string',
                'nullable',
            ],
            'website.details' => [
                'string',
                'nullable',
            ],
            'website.team_id' => [
                'integer',
                'exists:teams,id',
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['team'] = Team::pluck('name', 'id')->toArray();
    }
}
