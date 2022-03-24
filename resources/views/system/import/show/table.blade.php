<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-lg-7 col-md-7 col-sm-6">
						<b>Listado de módulos de importación</b>
					</div>

				</div>
			</div>
			<div class="card-datatable table-responsive">
				<table class="datatables-demo table table-striped table-bordered" id="table-generated">
					<thead>
						<tr>
							<th>#</th>
							<th>Nombre</th>
							<th>Descripción</th>
							<th>Importaciones</th>
							<th>Importar</th>
						</tr>
					</thead>
					<tbody>
					@foreach($imports as $import)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $import->name }}</td>
							<td>{{ $import->description }}</td>
							<td>{{ $import->files_count }}</td>
							<td><a href="importFile/{{ $import->slug }}" class="btn btn-primary btn-xs">Ir a importar</a></td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
{!! includeDT() !!}
{!! getSimpleTableScript() !!}
