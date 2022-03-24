<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                Sr/a. {{ $driver->user->getFullName() }}
            </div>
            <div class="card-body">
                <p class="alert alert-info">
                    <strong>Importante!</strong><br>
                    Antes de cargar nuevos servicios de transporte debe indicar el turno y el movil que esta usando.
                </p>
                <form class="" role="form" id="driver-shift-form">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Turno</label>
                                <select name="shift_id" class="form-control">
                                    <option value="" disabled selected="">Seleccione...</option>
                                    @foreach($shifts as $shift)
                                        <option value="{{ $shift->id }}">{{ $shift->start_time }} - {{ $shift->end_time }} | {{ $shift->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Movil</label>
                                <select name="mobile_id" class="form-control">
                                    <option value="" disabled selected="">Seleccione...</option>
                                    @foreach($mobiles as $mobile)
                                        <option value="{{ $mobile->id }}">{{ $mobile->mobile }} - {{ $mobile->patent }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>
{!! makeValidation('#driver-shift-form','/driverCreatesShift','location.reload()') !!}

