<?php

namespace App\Http\Livewire\MarketResearch;

use App\Models\MarketResearch;
use App\Models\Team;
use Livewire\Component;

class Create extends Component
{
    public array $listsForFields = [];

    public MarketResearch $marketResearch;

    public function mount(MarketResearch $marketResearch)
    {
        $this->marketResearch = $marketResearch;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.market-research.create');
    }

    public function submit()
    {
        $this->validate();

        $this->marketResearch->save();

        return redirect()->route('admin.market-researchs.index');
    }

    protected function rules(): array
    {
        return [
            'marketResearch.title' => [
                'string',
                'nullable',
            ],
            'marketResearch.details' => [
                'string',
                'nullable',
            ],
            'marketResearch.team_id' => [
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
