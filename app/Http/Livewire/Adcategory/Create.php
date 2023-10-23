<?php

namespace App\Http\Livewire\Adcategory;

use App\Models\Adcategory;
use Livewire\Component;

class Create extends Component
{
    public Adcategory $adcategory;

    public function mount(Adcategory $adcategory)
    {
        $this->adcategory = $adcategory;
    }

    public function render()
    {
        return view('livewire.adcategory.create');
    }

    public function submit()
    {
        $this->validate();

        $this->adcategory->save();

        return redirect()->route('admin.adcategories.index');
    }

    protected function rules(): array
    {
        return [
            'adcategory.name' => [
                'string',
                'required',
                'unique:adcategories,name',
            ],
        ];
    }
}
