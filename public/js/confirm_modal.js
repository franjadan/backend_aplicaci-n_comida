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
});

