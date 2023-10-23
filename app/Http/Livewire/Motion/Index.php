<?php

namespace App\Http\Livewire\Motion;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\Motion;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithSorting, WithConfirmation;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    protected $queryString = [
        'search' => [
            'except' => '',
        ],
        'sortBy' => [
            'except' => 'id',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
    ];

    public function getSelectedCountProperty()
    {
        return count($this->selected);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function resetSelected()
    {
        $this->selected = [];
    }

    public function mount()
    {
        $this->sortBy            = 'id';
        $this->sortDirection     = 'desc';
        $this->perPage           = 100;
        $this->paginationOptions = config('project.pagination.options');
        $this->orderable         = (new Motion())->orderable;
    }

    public function render()
    {
        $query = Motion::with(['team'])->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $motions = $query->paginate($this->perPage);

        return view('livewire.motion.index', compact('motions', 'query'));
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('motion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Motion::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(Motion $motion)
    {
        abort_if(Gate::denies('motion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $motion->delete();
    }
}
