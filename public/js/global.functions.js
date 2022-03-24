$(document).ready(function(){

});

function closeModal(){
    $('#remoteModal').modal('toggle');
}

function logout(){
    location.href = '/logout';
}

function getView(url,element){
    $.get(url,function(data){$(element).html(data)});
}


function loadModal(url) {
    $.get(url, function (data) {
        $('#remoteModal .modal-content').html(data);
    });
}


