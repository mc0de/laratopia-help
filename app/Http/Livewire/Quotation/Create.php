<?php

namespace App\Http\Livewire\Quotation;

use App\Models\Quotation;
use Livewire\Component;

class Create extends Component
{
    public Quotation $quotation;

    public function mount(Quotation $quotation)
    {
        $this->quotation = $quotation;
    }

    public function render()
    {
        return view('livewire.quotation.create');
    }

    public function submit()
    {
        $this->validate();

        $this->quotation->save();

        return redirect()->route('admin.quotations.index');
    }

    protected function rules(): array
    {
        return [
            'quotation.title' => [
                'string',
                'required',
            ],
            'quotation.details' => [
                'string',
                'nullable',
            ],
        ];
    }
}
