<div class="modal-header bg-primary text-white">
    <h4 class="text-center text-white"><i class="fas @yield('modal-icon') fa-lg "></i> @yield('modal-title')</h4>
</div>
<div class="modal-body">
    @yield('modal-content')
</div>
<div class="modal-footer">
    @hasSection('no-submit')
        @yield('no-submit')
    @else
        <button type="button" class="btn btn-primary" onClick="$('.modal-content form').submit();">Guardar</button>
    @endif
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>
@yield('modal-validation')
<script>
    $(document).ready(function(){
        $('.modal-dialog').css('width','@hasSection('modal-width')@yield('modal-width')@else 40 @endif%');
    });

    $('.fire-modal').on('click',function(e){
        e.preventDefault();
        loadModal($(this).attr('href'))
    });
</script>
