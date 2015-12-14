function bootstrapCollectionBorrarItem(item) {
    $(item).parent().parent().remove();
}


function modalAlert(msg) {
    $('#modal-alert .modal-body').html(msg);
    $('#modal-alert').modal('toggle');
}