$(function() {
    $('.my-custom-alert').hide();

    $('.show-alert').click(function(event) {
        let item = this.id.split('-')[3];
        let width = $('#page-content-wrapper').width();
        let height = $('#page-content-wrapper').height();

        $('.my-custom-alert').css({'top': height / 2 + 'px', 'left': width / 2 + 'px'});
        $('.my-custom-alert').fadeIn(function() {
            $('.card').unbind('mouseenter mouseleave');
            $('#card-option-edit-' + item).attr('aria-disabled', 'true').addClass('option-disabled');
            $('#card-option-delete-' + item).unbind('click').addClass('option-disabled');

            $('.option-accept').click(function(event) {
                $('#card-form-' + item).submit();
            });
        });
    });
});
