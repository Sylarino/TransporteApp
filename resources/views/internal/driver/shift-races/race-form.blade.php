<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h5>Crear nueva carrera</h5>
            </div>
            <div class="card-body">
                <p>
                    <strong>Datos</strong><br><br>
                    Conductor: {{ $driver->user->getFullName() }} <br>
                    Turno: {{ $driver_shift->shift->name }}<br>
                    Movil: {{ $driver_shift->mobile->mobile }}-{{ $driver_shift->mobile->patent }}
                </p>
                <hr>
                <form class="" role="form" id="driver-race-form" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Hora de Inicio</label>
                                <div class="row">
                                    <div class="col-5">
                                        <select id="start-time-hour" name="start_time_hour" class="form-control">
                                            <option value="" disabled selected="">Seleccione...</option>
                                            @for($i=0;$i<25;$i++)
                                                <option value="{{ numberWithLeadZero($i) }}">{{ numberWithLeadZero($i) }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <center>:</center>
                                    </div>
                                    <div class="col-5">
                                        <select id="start-time-minute" name="start_time_minutes" class="form-control">
                                            @for($i=0;$i<61;$i++)
                                                <option value="{{ numberWithLeadZero($i) }}">{{ numberWithLeadZero($i) }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Hora de Termino</label>
                                <div class="row">
                                    <div class="col-5">
                                        <select id="end-time-hour" name="end_time_hour" class="form-control">
                                            <option value="" disabled selected="">Seleccione...</option>
                                            @for($i=0;$i<25;$i++)
                                                <option value="{{ numberWithLeadZero($i) }}">{{ numberWithLeadZero($i) }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <center>:</center>
                                    </div>
                                    <div class="col-5">
                                        <select id="end-time-minute" name="end_time_minutes" class="form-control">
                                            @for($i=0;$i<61;$i++)
                                                <option value="{{ numberWithLeadZero($i) }}">{{ numberWithLeadZero($i) }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Origen</label>
                                <select id="from_id" name="from_id" class="form-control">
                                    <option value="" disabled selected="">Seleccione...</option>
                                    <option value="">Otro</option>
                                    @foreach($destinations as $destination)
                                        <option value="{{ $destination->id }}">{{ $destination->destination }}</option>
                                    @endforeach
                                </select>
                                <div id="from_input_id">
                                    <label class="form-label">Ingreso Manual</label>
                                    <input type="text" name="from_text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Destino</label>
                                <select id="to_id" name="to_id" class="form-control">
                                    <option value="" disabled selected="">Seleccione...</option>
                                    <option value="">Otro</option>
                                    @foreach($destinations as $destination)
                                        <option value="{{ $destination->id }}">{{ $destination->destination }}</option>
                                    @endforeach
                                </select>
                                <div id="to_input_id">
                                    <label class="form-label">Ingreso Manual</label>
                                    <input type="text" name="to_text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label class="form-label">Pasajeros ( solicitante ) </label>
                                <input type="text" name="passengers" class="form-control">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">Cantidad </label>
                                <select name="passengers_count" class="form-control">
                                    @for($i=0;$i<5;$i++)
                                        <option value="{{ numberWithLeadZero($i) }}">{{ numberWithLeadZero($i) }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">KM Inicio</label>
                                <input type="text" name="start_mileage" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">KM Termino</label>
                                <input type="text" name="end_mileage" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Observaciones del viaje(opcional)</label>
                                <textarea type="text" name="observations" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Subir Imagenes</label>
                                <input type="file" id="file_image" name="file_image" class="form-control" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
{!! makeValidation('#driver-race-form','/addRace/'.$driver->id,'location.reload()') !!}
{!! validateHours('#end-time-hour', '#end-time-minute','#start-time-hour', '#start-time-minute','#driver-race-form') !!}
{!! hideInput('#from_id', '#to_id','#from_input_id','#to_input_id','#driver-race-form') !!}

