$(function() {
    setTimeout(() => {
        $('.previous .page-link').html('<i class="fas fa-arrow-left"></i>').addClass('mx-3');
        $('.next .page-link').html('<i class="fas fa-arrow-right"></i>').addClass('mx-3');
        $('.page-link').addClass('shadow-sm');
    }, 0);
});
