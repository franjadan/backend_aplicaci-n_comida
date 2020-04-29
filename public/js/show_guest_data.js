$(function() {
    $('.guest-data').hide();
    $('#selectUser').change(function() {
        if (this.value === 'guest'){
            $('.guest-data').fadeIn();
        }else{
            $('.guest-data').fadeOut();
        }
    });
});
