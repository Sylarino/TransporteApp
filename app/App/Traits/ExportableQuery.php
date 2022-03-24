<?php

namespace App\App\Traits;

use Illuminate\Support\Facades\Schema;

trait ExportableQuery
{

    protected $builder;

    public function __construct()
    {
        $this->builder = $this->builder();
    }

    public function query ()
    {
        return $this->builder->select($this->getSelectedColumns());
    }

    public function getSelectedColumns()
    {
        return array_values($this->getHeaderColumns());
    }


    public function getHeaderColumns()
	{
		if (isset($this->displayable) && !empty($this->displayable)) {
			return $this->displayable;
		} else {
			return $this->getDisplayableColumns();
		}
	}

	public function getDisplayableColumns()
	{
		return array_values(
			array_diff(
				$this->getDatabaseColumnNames(),
				$this->builder->getModel()->getHidden()
			)
		);
	}

	protected function getDatabaseColumnNames()
	{
		return Schema::getColumnListing($this->builder->getModel()->getTable());
	}

	public function headings(): array
	{
		return $this->getHeaderColumns();
	}
}
