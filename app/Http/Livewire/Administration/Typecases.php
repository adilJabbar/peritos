<?php

namespace App\Http\Livewire\Administration;

use App\Models\Admin\Typecase;
use App\Traits\DataTable\WithBulkActions;
use App\Traits\DataTable\WithFilters;
use App\Traits\DataTable\WithPerPagePagination;
use App\Traits\DataTable\WithSorting;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Typecases extends Component
{
    use WithPerPagePagination,
        WithSorting,
        WithBulkActions,
        WithFilters;

    public Typecase $typecase;

    public $showFilters;

    public $showEditModal = false;

    public $showDeleteModal = false;

    public $isNew = true;

    public $filters = [
        'preexistences' => '',
        'tasacion' => '',
    ];

    public function rules()
    {
        return [
            'typecase.name' => 'required',
            'typecase.typecase' => 'required',
            'typecase.iso' => ['required', 'max:3', 'min:3', Rule::unique('currencies', 'iso')->ignore($this->typecase)],
            'typecase.decimal' => '',
            'typecase.separator' => '',
            'typecase.decimals' => 'required|numeric',
            'typecase.usd_rate' => 'required|numeric',
            'typecase.position' => 'required|in:after,before',
        ];
    }

    public function render()
    {
        return view('livewire.administration.typecases');
    }
}
