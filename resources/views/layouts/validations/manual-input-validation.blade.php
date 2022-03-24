<script>
    $(document).ready(function(){
        var from_select = $('{{ $from_id }}');
        var to_select = $('{{ $to_id }}');
        var from_input = $('{{ $from_input_id }}');
        var to_input = $('{{ $to_input_id }}');

        from_select.on('change', function(e){
            disableInput(from_select, from_input);
        });

        to_select.on('change', function(e){
            disableInput(to_select, to_input);
        });
        function disableInput(selected_select, input_to_change) {
            if(selected_select.val()==null || selected_select.val()==''){
                input_to_change.find('input').val('');
                input_to_change.removeClass('d-none');  
            } else {
                input_to_change.find('input').val('');
                input_to_change.addClass('d-none');
            }
        }
    });
</script>