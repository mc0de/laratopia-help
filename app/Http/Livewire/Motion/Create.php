<?php

namespace App\Http\Livewire\Motion;

use App\Models\Motion;
use App\Models\Team;
use Livewire\Component;

class Create extends Component
{
    public Motion $motion;

    public array $listsForFields = [];

    public function mount(Motion $motion)
    {
        $this->motion = $motion;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.motion.create');
    }

    public function submit()
    {
        $this->validate();

        $this->motion->save();

        return redirect()->route('admin.motions.index');
    }

    protected function rules(): array
    {
        return [
            'motion.title' => [
                'string',
                'nullable',
            ],
            'motion.details' => [
                'string',
                'nullable',
            ],
            'motion.minuts' => [
                'string',
                'nullable',
            ],
            'motion.team_id' => [
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
