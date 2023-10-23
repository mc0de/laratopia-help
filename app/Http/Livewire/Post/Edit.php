<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use App\Models\Postcategory;
use App\Models\Project;
use App\Models\Team;
use Livewire\Component;

class Edit extends Component
{
    public Post $post;

    public array $category = [];

    public array $listsForFields = [];

    public function mount(Post $post)
    {
        $this->post     = $post;
        $this->category = $this->post->category()->pluck('id')->toArray();
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.post.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->post->save();
        $this->post->category()->sync($this->category);

        return redirect()->route('admin.posts.index');
    }

    protected function rules(): array
    {
        return [
            'post.project_id' => [
                'integer',
                'exists:projects,id',
                'nullable',
            ],
            'post.title' => [
                'string',
                'nullable',
            ],
            'post.content' => [
                'string',
                'nullable',
            ],
            'category' => [
                'array',
            ],
            'category.*.id' => [
                'integer',
                'exists:postcategories,id',
            ],
            'post.status' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['status'])),
            ],
            'post.confirmation' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['confirmation'])),
            ],
            'post.note' => [
                'string',
                'nullable',
            ],
            'post.review' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['review'])),
            ],
            'post.team_id' => [
                'integer',
                'exists:teams,id',
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['project']      = Project::pluck('name', 'id')->toArray();
        $this->listsForFields['category']     = Postcategory::pluck('name', 'id')->toArray();
        $this->listsForFields['status']       = $this->post::STATUS_RADIO;
        $this->listsForFields['confirmation'] = $this->post::CONFIRMATION_RADIO;
        $this->listsForFields['review']       = $this->post::REVIEW_RADIO;
        $this->listsForFields['team']         = Team::pluck('name', 'id')->toArray();
    }
}
