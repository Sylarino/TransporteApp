@extends('layouts.main.app')
@section('page-title','Exportar Data')
@section('page-icon','download')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-7 col-md-7 col-sm-6">
                            <b>Listado de exportables</b>
                        </div>
                    </div>
                </div>
                <div class="card-datatable table-responsive">
                    {!! makeTable($cols,$rows) !!}
                </div>
            </div>
        </div>
    </div>
    {!! getSimpleTableScript() !!}
    <script>
        $('.is-ajaxButton').click(function(e){
            e.preventDefault();
            $.ajax({
                type : "GET",
                url : $(this).href,
                success: function(data){
                    toastr.success('Se le notificara el link de descarga cuando el archivo este listo.');
                },
                error : function(data){
                    console.log(data.responseText);
                    var obj = jQuery.parseJSON(data.responseText);
                    if (obj.error) {
                        toastr.error( obj.error);
                        swal.close();
                    }
                }
            });
        });
    </script>
@endsection

