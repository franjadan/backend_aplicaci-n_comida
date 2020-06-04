$(function() {
    if ($('.user').val() != '' || $('.order').val() == '') {
        $('.guest-data').hide();
    }

    $('#selectUser').change(function() {
        if ($(this).children(":selected").attr("id") == 'guest'){
            $('.guest-data').fadeIn();
        }else{
            $('#guest_name').val('');
            $('#guest_address').val('');
            $('#guest_phone').val('');
            $('.guest-data').fadeOut();
        }
    });
});