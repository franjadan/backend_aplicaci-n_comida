$(function() {
    $('.guest-data').hide();
    $('#selectUser').change(function() {
        if ($(this).children(":selected").attr("id") == 'guest'){
            $('.guest-data').fadeIn();
        }else{
            $('.guest-data').fadeOut();
        }
    });
});
