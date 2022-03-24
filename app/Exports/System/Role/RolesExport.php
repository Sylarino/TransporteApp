<?php

namespace App\Exports\System\Role;

use App\App\Traits\ExportableQuery;
use App\Domain\System\Role\Role;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RolesExport implements FromQuery, WithHeadings, ShouldAutoSize
{
    use ExportableQuery;

	public $displayable = [
		'id','slug','name'
	];

	public function builder()
    {
        return Role::query();
    }
}
