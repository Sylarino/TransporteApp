function handleFormErrors(json){
    $('.form-control').removeClass('is-invalid').addClass('is-valid');
    $('.error-tooltip').remove();

    $.each( json.errors, function( key, value ) {
        $('[name="'+key+'"]').removeClass('is-valid').addClass('is-invalid')
            .after('<div id="'+key+'-error" class="error-tooltip">'+value+'</div>');
    });
    toastr.error( 'Complete el formulario', 'Error');
}

function deleteRecord(texto,url,aditionals){
    swal({
        title: "Eliminar Registro",
        text: texto,
        type: "error",
        showCancelButton: true,
        confirmButtonClass: 'btn-danger',
        confirmButtonText: 'Sí, eliminar!',
        closeOnConfirm: false
    }, function (isConfirm) {
        if(isConfirm){
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type : "POST",
                url : url,
                data : {_method: "delete", _token:token },
                success: function(data){
                    if(aditionals){
                        if(aditionals === 'reload'){
                            tableReload();
                        }else{
                            if(aditionals === 'removeFile'){
                                $('#tr-'+id).remove();
                                closeModal();
                            }else{
                                $('#tr-'+id).remove();
                            }
                        }
                        toastr.success("Registro eliminado correctamente.");
                        swal.close();
                    }else{
                        location.reload();
                    }
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
        }else{
            swal.close();
        }
    });

}
