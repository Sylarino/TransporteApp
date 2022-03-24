@extends('layouts.main.app')
@section('page-title')
	Módulos de importación
	<a href="javascript:void(0);" class="btn btn-outline-secondary btn-sm" id="list-view"><i class="fas fa-2x fa-table"></i></a>
	<a href="javascript:void(0);" class="btn btn-outline-secondary btn-sm" id="item-view"><i class="fas fa-2x fa-boxes"></i></a>

    {!! makeLink('/queuedImports','Administrar sequencias','fa-list-ol','btn-primary float-right') !!}
@endsection
@section('page-icon','cloud-upload-alt')
@section('content')
	<div id="import-view-content">

	</div>

	<script>
		$(document).ready(function(){
		    $('#list-view').click();
		});
		$('#list-view').click(function(){
			$(this).removeClass('btn-outline-secondary').addClass('btn-primary');
			$('#item-view').removeClass('btn-primary').addClass('btn-outline-secondary');
			getViewImport('list');
		});

		$('#item-view').click(function(){
            $(this).removeClass('btn-outline-seconday').addClass('btn-primary');
            $('#list-view').removeClass('btn-primary').addClass('btn-outline-secondary');
            getViewImport('item');
        });

		function getViewImport(url)
		{

		    $.get('/getImports/' + url, function(data){
		       $('#import-view-content').html(data)
		    });
		}
	</script>
@endsection

