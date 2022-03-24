<script>
    function callChart(view,callback) {
        var html = '<h5>Cargando Gráfico <i class="fa fa-spin fa-spinner"></i></h5>';
        $.ajax({
            type : "GET",
            url : '/chartView/'+view+'?{!! (isset($params))?$params.'&device_id='.$device_id:'?device_id='.$device_id !!}',
            beforeSend: function(data) {
                $('#'+view+'ChartContainer').html(html);
            },
            success: function(data){
                $('#'+view+'ChartContainer').html(data);
                if(callback) {
                    callback();
                }
            }
        });
    }
</script>
