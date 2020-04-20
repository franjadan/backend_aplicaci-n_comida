$(function() {
    setTimeout(() => {
        console.log('okey');
        $('.previous .page-link').html('<i class="fas fa-arrow-left"></i>').addClass('mx-3');
        $('.next .page-link').html('<i class="fas fa-arrow-right"></i>').addClass('mx-3');
        $('.page-link').addClass('shadow-sm');
        $('div.dataTables_wrapper div.dataTables_length label').hide();
        $('div.dataTables_wrapper div.dataTables_info').hide();
    }, 0);
});
