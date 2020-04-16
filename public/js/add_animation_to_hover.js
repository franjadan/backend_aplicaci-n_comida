$(function() {
    $('.card-options').hide();

    $('.card').hover(function() {
        $('#' + this.id).addClass('shadow').animate({ width: '100%', height: '85%' }, 'fast');
        $('#card-options-' + this.id.split('-')[2]).fadeIn('slow')
    }, function() {
        $('#' + this.id).removeClass('shadow').animate({ width: '95%', height: '80%' }, 'fast');
        $('#card-options-' + this.id.split('-')[2]).hide();
    });
});
