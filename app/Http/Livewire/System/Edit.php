<?php

namespace App\Http\Livewire\System;

use App\Models\System;
use App\Models\Team;
use Livewire\Component;

class Edit extends Component
{
    public System $system;

    public array $listsForFields = [];

    public function mount(System $system)
    {
        $this->system = $system;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.system.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->system->save();

        return redirect()->route('admin.systems.index');
    }

    protected function rules(): array
    {
        return [
            'system.title' => [
                'string',
                'required',
            ],
            'system.details' => [
                'string',
                'nullable',
            ],
            'system.team_id' => [
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
