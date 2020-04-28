$(function() {
    $('.alert-refresh-orders').hide();
    $.getJSON('/api/pedidos').done(function(data) {
        let olds = data['response']['data'];
        setInterval(function() {
            $.getJSON('http://127.0.0.1:8000/api/pedidos').done(function(data) {
                let news = data['response']['data'];
                if (news > olds) {
                    $('.refresh-orders-title').html('¡ATENCIÓN, tienes ' + (news - olds) + ' pedido/s nuevo/s!');
                    $('.alert-refresh-orders').fadeIn('slow');
                }
            });
        }, 180000);
    });
});
