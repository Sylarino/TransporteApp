<?php

namespace App\Exports\System\Menu;

use App\App\Traits\ExportableQuery;
use App\Domain\System\Menu\Menu;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MenusExport implements FromQuery, WithHeadings,ShouldAutoSize
{
	use ExportableQuery;

	public function builder()
    {
        return Menu::query();
    }

}
