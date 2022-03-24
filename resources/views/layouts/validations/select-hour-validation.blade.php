<script>
    $(document).ready(function(){
        var select_end_hour = $('{{ $select_hour_end }}');
        var select_end_minute = $('{{ $select_minute_end }}');
        var select_start_hour = $('{{ $select_hour_start }}');
        var select_start_minute = $('{{ $select_minute_start }}');
        var form = $('{{ $form }}');

        function preHourValidation(select_element){
            if (select_element.val() == null){

            } else {
                validateEndTime(select_end_hour.val(), select_end_minute.val(), select_start_hour.val(), select_start_minute.val());
            }        
        }

        function preMinuteValidation(first_select_element, second_select_element){
            if (first_select_element.val() == null || second_select_element.val() == null){

            } else {
                validateEndTime(select_end_hour.val(), select_end_minute.val(), select_start_hour.val(), select_start_minute.val());
            }        
        }

        select_end_hour.on('change', function(e){
            preHourValidation(select_start_hour);     
        });

        select_end_minute.on('change', function(e){
            preMinuteValidation(select_end_hour, select_start_hour);
        });

        select_start_hour.on('change', function(e){
            preHourValidation(select_end_hour);
        });

        select_start_minute.on('change', function(e){
            preMinuteValidation(select_end_hour, select_start_hour);
        });

        function validateEndTime(endHour, endMinute, startHour, startMinute) {

            function newDate(hour, minute) {
                var date = new Date(0);
                date.setHours(hour);
                date.setMinutes(minute);
                return date;
            }

            function prefijo(num) {
                return num < 10 ? ("0" + num) : num; 
            }

            function alertConfirm(message) {
                Swal.fire({
                    title: '¿Estas seguro?',
                    text: message,
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, continuar'
                    });
            }

            var endDate = newDate(endHour, endMinute);
            var startDate = newDate(startHour, startMinute);

            var newDateSum = new Date(startDate.getTime() + ((3 * 60) * 60000));

            if(endDate.getTime() > newDateSum.getTime()){
                if($("#alert-hours").length > 0){
                    $("#alert-hours").remove();
                }
                alertConfirm("El viaje supera las tres horas. Se agregara de igual manera dejando un registro");
                form.prepend("<div id='alert-hours' class='alert alert-warning alert-dismissible fade show'>Supera las tres horas<button type='button' class='close' data-dismiss='alert'>×</button></div>");
            }

            if(startDate.getTime() > endDate.getTime()){
                if($("#alert-hours").length > 0){
                    $("#alert-hours").remove();
                }
                alertConfirm("La hora de termino es inferior a la hora de Inicio. Se agregara de igual manera dejando un registro de que finalizo el siguiente día"); 
                form.prepend("<div id='alert-hours' class='alert alert-warning alert-dismissible fade show'>La hora de termino es inferior a la hora de Inicio.<button type='button' class='close' data-dismiss='alert'>×</button></div>");
            }
        }
    });
</script>