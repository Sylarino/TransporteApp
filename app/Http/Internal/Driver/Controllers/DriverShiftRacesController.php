<?php

namespace App\Http\Internal\Driver\Controllers;

use App\Domain\Internal\Driver\Driver;
use App\Domain\Internal\Driver\DriverShift;
use App\Domain\Internal\Mobile\Mobile;
use App\Domain\Internal\Shift\Shift;
use App\Domain\Transport\Destination\Destination;
use App\Http\Internal\Driver\Requests\DriverShiftRacesRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\App\Controllers\Controller;
use Sentinel;

class DriverShiftRacesController extends Controller
{
    public function index()
    {
        $driver = Driver::where('user_id',Sentinel::getUser()->id)->first();
        $shifts = Shift::get();
        $mobiles = Mobile::get();
        $driver_shift = $driver->hasShiftCreated();
        if ($driver_shift) {
           $destinations = Destination::where('workplace_id',$driver_shift->mobile->service_id)->get();
        } else {
            $destinations = null;
        }
        return view('internal.driver.shift-races.index', compact('driver','shifts','mobiles','driver_shift', 'destinations'));
    }

    public function createShift(DriverShiftRacesRequest $request)
    {
        $shift = Shift::find($request->shift_id);
        $mobile = Mobile::find($request->mobile_id);
        $driver = Driver::where('user_id',Sentinel::getUser()->id)->first();

        if(DriverShift::create([
            'driver_id' => $driver->id,
            'shift_id' => $shift->id,
            'mobile_id' => $mobile->id,
            'date' => Carbon::now()->toDateString()
        ])) {
            return $this->getResponse('success.store');
        } else {
            return $this->getResponse('error.store');
        }
    }
}
