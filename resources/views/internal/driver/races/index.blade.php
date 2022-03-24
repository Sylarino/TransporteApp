@extends('layouts.main.app')
@section('page-title','Carreras de mi ultimo turno')
@section('page-icon','list')
@section('content')
  <div class="row">
      <div class="col">
          <div class="card">
              <div class="card-header">
                  Listado de carreras del turno
              </div>

              <div class="card-body card-datatable table-responsive">
                  <p class="p-5">
                      <strong>Datos</strong><br><br>
                      Conductor: {{ $driver->user->getFullName() }} <br>
                      Turno: {{ $driverShift->shift->name }}<br>
                      Movil: {{ $driverShift->mobile->mobile }}-{{ $driverShift->mobile->patent }}
                      Fecha: {{ $driverShift->date }}
                  </p>
                  <table class="table table-striped" id="table-races">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Hora Inicio</th>
                              <th>Hora Termino</th>
                              <th>Origen</th>
                              <th>Destino</th>
                              <th>Solicitante</th>
                              <th>Pasajeros</th>
                              <th>KM Inicio</th>
                              <th>KM Termino</th>
                              <th>Observaciones</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($races as $race)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $race->start_time }}</td>
                                <td>{{ $race->end_time }}</td>
                                <td>{{ (optional($race->from_destination)->destination)?optional($race->from_destination)->destination:$race->from_text }}</td>
                                <td>{{ (optional($race->to_destination)->destination)?optional($race->to_destination)->destination:$race->to_text }}</td>
                                <td>{{ $race->passengers }}</td>
                                <td>{{ $race->passengers_count }}</td>
                                <td>{{ $race->start_mileage }}</td>
                                <td>{{ $race->end_mileage }}</td>
                                <td>{{ ($race->observations != '')?$race->observations:'Sin Observaciones' }}</td>
                            </tr>
                        @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
    {!!  getSimpleTableScript('table-races') !!}
@endsection
