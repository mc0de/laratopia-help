<?php

namespace App\Http\Livewire\Videocategory;

use App\Models\Videocategory;
use Livewire\Component;

class Edit extends Component
{
    public Videocategory $videocategory;

    public function mount(Videocategory $videocategory)
    {
        $this->videocategory = $videocategory;
    }

    public function render()
    {
        return view('livewire.videocategory.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->videocategory->save();

        return redirect()->route('admin.videocategories.index');
    }

    protected function rules(): array
    {
        return [
            'videocategory.name' => [
                'string',
                'required',
                'unique:videocategories,name,' . $this->videocategory->id,
            ],
        ];
    }
}
