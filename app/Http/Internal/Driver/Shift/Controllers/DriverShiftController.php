<?php

namespace App\Http\Internal\Driver\Shift\Controllers;

use App\Domain\Internal\Driver\Driver;
use App\Domain\Internal\Driver\DriverShift;
use Illuminate\Http\Request;
use App\App\Controllers\Controller;
use Sentinel;

class DriverShiftController extends Controller
{
    public function index()
    {
        $driver = Driver::where('user_id',Sentinel::getUser()->id)->first();
        $driverShift = DriverShift::with('races')->where('driver_id',$driver->id)->latest('date')->first();

        $races = $driverShift->races;
        return view('internal.driver.races.index',compact('driver','driverShift','races'));
    }
}
