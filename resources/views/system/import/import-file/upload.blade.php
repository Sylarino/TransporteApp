@extends('layouts.modal.layout')
@section('modal-icon','fa-upload')
@section('modal-title','Subir Archivo')
@section('modal-content')
    {!! printCss(['libs/dropzone/dropzone.css']) !!}
    {!! printScript(['libs/dropzone/dropzone.js']) !!}
    <form class="dropzone" action="/importFile/upload"  enctype="multipart/form-data" id="dropzoneForm">
        @csrf
        <input type="hidden" value="{{ $slug }}" name="slug">
        <div class="fallback">
            <input name="file" type="file" multiple />
        </div>
    </form>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#dropzoneForm").dropzone({
                method: 'POST',
                acceptedFiles : '.csv',
                queuecomplete : function(){
                    toastr.success('Se han cargado los archivos.');
                    location.reload()
                },
                error : function (response){
                    var messages = jQuery.parseJSON(response.responseText);
                    if(response.status == 401){
                        if(messages.error){
                            toastr.error(messages.error,'Error!');
                        }else{
                            toastr.error('Error al cargar los archivos','Error!');
                        }
                    }
                }
            });
        });
    </script>
@endsection
@section('no-submit','Si no desea cargar archivos presione')
@section('modal-width','40')
