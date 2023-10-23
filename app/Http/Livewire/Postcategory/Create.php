<?php

namespace App\Http\Livewire\Postcategory;

use App\Models\Postcategory;
use Livewire\Component;

class Create extends Component
{
    public Postcategory $postcategory;

    public function mount(Postcategory $postcategory)
    {
        $this->postcategory = $postcategory;
    }

    public function render()
    {
        return view('livewire.postcategory.create');
    }

    public function submit()
    {
        $this->validate();

        $this->postcategory->save();

        return redirect()->route('admin.postcategories.index');
    }

    protected function rules(): array
    {
        return [
            'postcategory.name' => [
                'string',
                'required',
                'unique:postcategories,name',
            ],
        ];
    }
}
