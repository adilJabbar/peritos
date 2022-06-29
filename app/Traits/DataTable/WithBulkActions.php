<?php

namespace App\Traits\DataTable;

trait WithBulkActions
{
    public $selectPage = false;

    public $selectAll = false;

    public $selected = [];

    public function renderingWithBulkActions()
    {
        if ($this->selectAll) {
            $this->selectPageRows();
        }
    }

    public function updatedSelectPage($value)
    {
        $value
            ? $this->selectPageRows()
            : $this->selected = [];
        $this->selectAll = false;
    }

    public function updatedSelected()
    {
        $this->selectAll = false;
        $this->selectPage = false;
    }

    public function selectAll()
    {
        $this->selectAll = true;
    }

    public function selectPageRows()
    {
        return $this->selected = $this->rows->pluck('id')->map(fn ($id) => (string) $id);
    }

    public function getSelectedRowsQueryProperty()
    {
        return (clone $this->rowsQuery)->unless($this->selectAll, fn ($query) => $query->whereKey($this->selected));
    }
}
