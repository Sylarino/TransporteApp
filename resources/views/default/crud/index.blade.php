<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-7 col-md-7 col-sm-6">
                        <b>Listado de Registros</b>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-6">
                        <div class="float-right">
                            @if(Route::has('export.'.$entity) && Sentinel::getUser()->hasAccess($entity.'.export'))
                                {!! makeLink('export/'.$entity,'Excel','fa-file-excel','btn-success','btn-sm') !!}
                            @endif&nbsp;
                                {!! makeAddLink() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-datatable table-responsive">
                {!! makeTable($cols,false) !!}
            </div>
        </div>
    </div>
</div>
{!! getAjaxTable($entity) !!}
