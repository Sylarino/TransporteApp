<?php

namespace App\Exports\System\User;

use App\App\Traits\ExportableQuery;
use App\Domain\System\User\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromQuery, WithHeadings, ShouldAutoSize
{
    use ExportableQuery;

    public $displayable = [
        'id','first_name','last_name','email','created_at'
    ];

    public function builder()
    {
        return User::query();
    }
}
