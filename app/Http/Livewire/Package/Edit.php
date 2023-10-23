<?php

namespace App\Http\Livewire\Package;

use App\Models\Package;
use Livewire\Component;

class Edit extends Component
{
    public Package $package;

    public function mount(Package $package)
    {
        $this->package = $package;
    }

    public function render()
    {
        return view('livewire.package.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->package->save();

        return redirect()->route('admin.packages.index');
    }

    protected function rules(): array
    {
        return [
            'package.name' => [
                'string',
                'required',
                'unique:packages,name,' . $this->package->id,
            ],
            'package.ads' => [
                'string',
                'nullable',
            ],
            'package.post' => [
                'string',
                'nullable',
            ],
            'package.design' => [
                'string',
                'nullable',
            ],
            'package.video' => [
                'string',
                'nullable',
            ],
            'package.platforms' => [
                'string',
                'nullable',
            ],
            'package.story' => [
                'string',
                'nullable',
            ],
        ];
    }
}
