<?php

namespace App\Http\Livewire\Project;

use App\Models\Package;
use App\Models\Project;
use App\Models\Team;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public Project $project;

    public array $package = [];

    public array $assignee = [];

    public array $listsForFields = [];

    public function mount(Project $project)
    {
        $this->project  = $project;
        $this->package  = $this->project->package()->pluck('id')->toArray();
        $this->assignee = $this->project->assignee()->pluck('id')->toArray();
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.project.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->project->save();
        $this->project->package()->sync($this->package);
        $this->project->assignee()->sync($this->assignee);

        return redirect()->route('admin.projects.index');
    }

    protected function rules(): array
    {
        return [
            'project.name' => [
                'string',
                'required',
                'unique:projects,name,' . $this->project->id,
            ],
            'project.owner_id' => [
                'integer',
                'exists:users,id',
                'required',
            ],
            'package' => [
                'required',
                'array',
            ],
            'package.*.id' => [
                'integer',
                'exists:packages,id',
            ],
            'project.start_date' => [
                'required',
                'date_format:' . config('project.date_format'),
            ],
            'project.end_date' => [
                'required',
                'date_format:' . config('project.date_format'),
            ],
            'project.statues' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['statues'])),
            ],
            'assignee' => [
                'required',
                'array',
            ],
            'assignee.*.id' => [
                'integer',
                'exists:users,id',
            ],
            'project.team_id' => [
                'integer',
                'exists:teams,id',
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['owner']    = User::pluck('name', 'id')->toArray();
        $this->listsForFields['package']  = Package::pluck('name', 'id')->toArray();
        $this->listsForFields['statues']  = $this->project::STATUES_RADIO;
        $this->listsForFields['assignee'] = User::pluck('email', 'id')->toArray();
        $this->listsForFields['team']     = Team::pluck('name', 'id')->toArray();
    }
}
