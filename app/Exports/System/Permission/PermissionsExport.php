<?php

namespace App\Exports\System\Permission;

use App\App\Traits\ExportableQuery;
use App\Domain\System\Permission\Permission;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PermissionsExport implements FromQuery, WithHeadings,ShouldAutoSize
{
    use ExportableQuery;

    public $displayable = [
        'id','slug','list'
    ];

    public function builder()
    {
        return Permission::query();
    }
}
