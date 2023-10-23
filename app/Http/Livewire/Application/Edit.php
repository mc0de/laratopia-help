<?php

namespace App\Http\Livewire\Application;

use App\Models\Application;
use App\Models\Team;
use Livewire\Component;

class Edit extends Component
{
    public Application $application;

    public array $listsForFields = [];

    public function mount(Application $application)
    {
        $this->application = $application;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.application.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->application->save();

        return redirect()->route('admin.applications.index');
    }

    protected function rules(): array
    {
        return [
            'application.title' => [
                'string',
                'required',
            ],
            'application.details' => [
                'string',
                'nullable',
            ],
            'application.team_id' => [
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
