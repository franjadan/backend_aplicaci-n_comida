$(function() {
    let url = window.location.href + 'api/pedidos';
    $('.alert-refresh-orders').hide();
    $.getJSON('/api/pedidos').done(function(data) {
        let olds = data['response']['data'];
        setInterval(function() {
            $.getJSON(url).done(function(data) {
                let news = data['response']['data'];
                if (news > olds) {
                    $('.refresh-orders-title').html('¡ATENCIÓN, tienes ' + (news - olds) + ' pedido/s nuevo/s!');
                    $('.alert-refresh-orders').fadeIn('slow');
                }
            });
        }, 180000);
    });
});
