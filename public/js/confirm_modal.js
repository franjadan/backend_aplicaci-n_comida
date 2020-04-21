$(function() {

    var id = 0;

    $('.showModalConfirmBtn').click(function(event) {
        event.preventDefault();
        id = $(this).data('id');

    });

    $('#acceptButton').click(function(event) {
        event.preventDefault();
        $('#deleteForm-' + id).submit();
    });

    $('#cancelOrderButton').click(function(event) {
        event.preventDefault();
        $('#cancelForm-' + id).submit();
    });

    $('#concludeOrderButton').click(function(event) {
        event.preventDefault();
        $('#concludeForm-' + id).submit();
    });
});

