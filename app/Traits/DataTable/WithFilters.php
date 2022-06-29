<?php

namespace App\Traits\DataTable;

trait WithFilters
{
    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }
}
