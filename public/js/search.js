$(document).ready(function(){
    closeSearch();
}).mouseup(function(e) {
    if (!$('#result-main-search').is(e.target) && $('#result-main-search').has(e.target).length === 0) {
        $('#result-main-search').hide();
    }
});

$('#q').keyup(function(){
    if (!$('#result-main-search').is(':visible')) {
        $('#result-main-search').show();
    }
});

$('#q').on('click',function(e) {
    if (!$('#result-main-search').is(':visible')) {
        $('#result-main-search').show();
    }
    e.preventDefault();
});
$('#q').on('change',function() {
    if (!$('#result-main-search').is(':visible')) {
        $('#result-main-search').show();
    }
   mainFind();
});

function mainFind(){
    var toFind = $('#q').val();
    if(toFind.trim() !== '') {
        $.get('/search/'+toFind, function(data) {
            $('#result-main-search').html(data);
            $('#result-main-search').show();
        });
    }

}
$('#q').keydown(function (e){
    if (e.keyCode == 13) {
        e.preventDefault();
        if($('.direct-search').attr('href') != null){
            location.href = $('.direct-search').attr('href');
        }
    }
});

function closeSearch(){
    $('#q').val('');
    $('#result-main-search').hide();
    $('#result-main-search').html('<div class="list-group list-group-flush"><a href="javascript:void(0);" class="list-group-item list-group-item-action media d-flex direct-search">Ingrese Rut, Razon Social u O/C para buscar.</a></div>');
}
