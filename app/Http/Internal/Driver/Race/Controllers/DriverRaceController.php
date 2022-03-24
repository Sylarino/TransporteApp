<?php

namespace App\Http\Internal\Driver\Race\Controllers;

use App\Domain\Internal\Driver\Driver;
use App\Domain\Internal\Races\RaceLog;
use App\Domain\Internal\Races\FileImage;
use App\Exports\Internal\Admin\AllTransportExport;
use App\Http\Internal\Driver\Race\Requests\DriverRaceRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\App\Controllers\Controller;
use Excel;
use Image;
use Illuminate\Support\Str;


class DriverRaceController extends Controller
{
    public function createRace(DriverRaceRequest $request,$id)
    {
        $start_time = $request->start_time_hour.':'.$request->start_time_minutes;
        $end_time = $request->end_time_hour.':'.$request->end_time_minutes;
        $next_day = null;
        $valid_day = false;
        ///

        if(strtotime(Carbon::now()->toDateString().' '.$start_time.':00') > strtotime(Carbon::now()->toDateString().' '.$end_time.':00')) {
            $date_day = Carbon::now();
            $date_day->addDays(1);  
            $next_day = $date_day->toDateString().' '.$end_time.':00';
            $valid_day = true;
            error_log("hola");
        }
        // $sum_hour = ($request->start_time_hour + 3).''.$request->start_time_minutes;
        // $finish_hour = $request->end_time_hour.''.$request->end_time_minutes;
        // $start_hour = $request->start_time_hour.''.$request->start_time_minutes;

        // if($finish_hour > $sum_hour || $start_hour >= $finish_hour) {
        //     return response()->json(['error' => ['end_time_hour' => 'La hora de termino supera las tres horas de viaje desde su inicio.']],401);
        // }
        
        ///
        if(strtotime(Carbon::now()->toDateString().' '.$start_time.':00' > strtotime(Carbon::now()->toDateString().' '.$end_time.':00'))) {
            return response()->json(['errors',['start_time_hour' => 'La hora de inicio debe ser menor que la de termino.']],422);
        }
        if ($request->from_id == '' && $request->from_text == '') {
           return response()->json(['errors',['from_id' => 'Debe Seleccionar origen o escribir el origen.']],422);
        }
        if ($request->to_id == '' && $request->to_text == '') {
            return response()->json(['errors',['to_id' => 'Debe Seleccionar destino o escribir el destino.']],422);
        }

        // if($request->hasFile('file_image')){
        //     $archivo = $request->file('file_image');        
        //     $nombre = $archivo->getClientOriginalName();
        //     \Storage::disk('local')->put($nombre, \File::get($archivo));                    
             
        //     return $this->getResponse('success.store');
        // }

        $driver = Driver::find($id);
        $driver_shift = $driver->hasShiftCreated();

        if ($driver_shift) {
            if(RaceLog::create([
                'driver_shift_id' => $driver_shift->id,
                'patent' => $driver_shift->mobile->patent,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'from_id' => $request->from_id,
                'from_text' => $request->from_text,
                'to_id' => $request->to_id,
                'to_text' => $request->to_text,
                'passengers_count' => $request->passengers_count,
                'passengers' => $request->passengers,
                'start_mileage' => $request->start_mileage,
                'end_mileage' => $request->end_mileage,
<<<<<<< HEAD
                'observations' => $request->observations,
                'next_day' => $next_day,
                'valid_day' => $valid_day
            ])) {
=======
                'observations' => $request->observations
            ])) 
            {

                // Descarga de Imagenes y consiguiente registro
                // $entrada=$request->all();

                // if ($request->hashFile('file_image'))
                // $file_path->move('evidence_files_transport', $name); 
                
                // $ruta = public_path().'/img/';

                // $img_og = $request->file('file_image');

                // $imagen = Image::make($img_og);

                // $temp_name = $img_og->getClientOriginalName();

                // $imagen->save($ruta . $temp_name, 100);

                // return $this->getResponse('success.store');

                $archivo = $request->file('file_image');   
                $nombre = $archivo->getClientOriginalName();
                $ruta = public_path("img/");
                $archivo->move($ruta, $nombre); 
>>>>>>> d7804b747987595f4cb0473f8fba0a746035868c
                return $this->getResponse('success.store');

            } else {
                return $this->getResponse('error.store');
            }
        } else {
            return response()->json(['error' => 'No puede crear carreras fuera del turno.'],401);
        }
        
    }

    public function index()
    {
        return view('internal.driver.races.admin');
    }

    public function export()
    {
        return Excel::download(new AllTransportExport, 'Transportes_listado_'.Carbon::now()->toDateString().'.xlsx');
    }
}
