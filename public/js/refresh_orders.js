$(function() {
    let url = window.location.origin.indexOf('35.181.4.122') != -1 ? window.location.origin + '/back_proyectocomidas/public/api/pedidos' : window.location.origin + '/api/pedidos';
    $('.alert-refresh-orders').hide();
    $.getJSON(url).done(function(data) {
        let olds = data['response']['data'];
        setInterval(function() {
            $.getJSON(url).done(function(data) {
                let news = data['response']['data'];
                if (news > olds) {
                    $('.refresh-orders-title').html('¡ATENCIÓN, tienes ' + (news - olds) + ' pedido/s nuevo/s!');
                    $('.alert-refresh-orders').fadeIn('slow');
                }
            });
        }, 30000);
    });
});
