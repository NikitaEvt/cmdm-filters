(function () {

    /* add to cart */
    $('body').on('click', '.button-buy', function (e) {
        e.preventDefault();
        $('#loadBox').show();
        var button = $(this);
        var product_id = button.data('product_id');
        var quantity = button.data('qty');
        $.ajax({
            url: '/cart/add/', // путь к обработчику
            type: 'POST', // метод отправки,
            dataType: 'json',
            data: {product_id: product_id, quantity: quantity},
            success: function (data) {
                $('.cart-price').html(data.cart_total + '<span class="currency"> €</span>');
                $('.item_total_cart').html(data.total_items);
                $('#loadBox').hide();
            },
            error: function (data) {
                console.log(data); // выводим ошибку в консоль
            }
        });
    });

    /* Update Cart */
    function update_cart(item, qty) {
        $.post('/cart/update', {rowid: item.attr('data-rowid'), quantity: qty}, function (r) {
            if (r.status == 'ok') {
                $('.header__acclist .cart .i-count').text(r.total_items);
                $('.start-order__total span:eq(0)').text(r.cart_total);

                $('.basket__item[data-rowid="' + r.item.rowid + '"] .basket__total span:eq(0)').text(r.item.subtotal);
            }
        }, 'json');
    }

    /* Remove from cart */
    $('body').on('click', '.delete_product_cart', function (e) {
        e.preventDefault();
        $('#loadBox').show();
        var products = $(this);
        var rowid = $(this).data('rowid');
        var id = $(this).data('id');
        var delivery = $('#delivery').data('delivery');
        if (confirm('Вы уверены, что хотите удалить этот элемент?')) {
            $.post('/cart/delete/', {rowid: rowid}, function (r) {
                if (r.status == 'ok') {
                    var cart_total = Number(r.cart_total);
                    $('.order-total__all-products-price').html(cart_total);
                    $('.order-total__total-price').html(cart_total + ' MDL');
                    $('.cart-btn__link-counter').html(r.total_items);
                    $('#loadBox').hide();
                    if (r.total_items == 0) {
                        window.location.reload();
                    }
                    products.parent().parent().parent().parent().remove();
                }
            }, 'json');
        }
    });


    $('body').on('click', '.button_buy_item', function (e) {
        e.preventDefault();
        $('#loadBox').show();
        var button = $(this);
        var product_id = button.data('product_id');
        var quantity = $('input[name="count"]').val();
        $.ajax({
            url: '/cart/add/', // путь к обработчику
            type: 'POST', // метод отправки,
            dataType: 'json',
            data: {product_id: product_id, quantity: quantity},
            success: function (data) {
                $('.desk-price').html(data.cart_total + ' MDL');
                $('.mob-price').html(data.cart_total);
                $('.cart-btn__link-counter').html(data.total_items);
                $('#loadBox').hide();
            },
            error: function (data) {
                console.log(data); // выводим ошибку в консоль
            }
        });
    });

    // count cart
    $('body').on('click', '.plus-basket-btn', function (e) {
        e.preventDefault();
        $('#loadBox').show();
        var button = $(this);
        var product_id = button.data('product_id');
        var quantity = 1;
        $('.sum-count-input').data('qty', 1);
        $.ajax({
            url: '/cart/add/', // путь к обработчику
            type: 'POST', // метод отправки,
            dataType: 'json',
            data: {product_id: product_id, quantity: quantity},
            success: function (data) {
                var cart_total = data.cart_total;
                $('.order-total__all-products-price').html(cart_total);
                $('.order-total__total-price').html(cart_total + ' MDL');
                $('.cart-btn__link-counter').html(data.total_items);
                $('#loadBox').hide();
            },
            error: function (data) {
                console.log(data); // выводим ошибку в консоль
            }
        });
    });

    // count cart
    $('body').on('click', '.minus-basket-btn', function (e) {
        e.preventDefault();
        var button = $(this);
        var product_id = button.data('product_id');
        var count = $('.sum-count-input').val();
        var qty = $('.sum-count-input').data('qty');
        var quantity = -1;
        if (count == 1){
            $('.sum-count-input').data('qty', 0);
        }
        if (qty == 0){
            quantity = 0;
        }

        $.ajax({
            url: '/cart/add/', // путь к обработчику
            type: 'POST', // метод отправки,
            dataType: 'json',
            data: {product_id: product_id, quantity: quantity},
            success: function (data) {
                var cart_total = data.cart_total;
                $('.order-total__all-products-price').html(cart_total);
                $('.order-total__total-price').html(cart_total + ' MDL');
                $('.cart-btn__link-counter').html(data.total_items);
            },
            error: function (data) {
                console.log(data); // выводим ошибку в консоль
            }
        });
    });

    $('body').on('click', '#to_order', function (e) {
        e.preventDefault();
        var name = $('input[name=name]').val();
        var phone = $('input[name=phone]').val();
        var email = $('input[name=email]').val();
        var comments = $('textarea[name=comments]').val();
        var url  = window.location.href;
        url  = url + '?order_success=1';

        if ($("input[type=checkbox]").is(":checked")) {
            $.ajax({
                url: '/order_success', // путь к обработчику
                type: 'POST', // метод отправки,
                dataType: 'html',
                data: {name: name, phone: phone, email: email, mesaj: comments},
                success: function (data) {
                    if (data === '1'){
                        $(location).attr('href',url);
                    }else{
                        $('#error_order').html(data);
                    }
                },
                error: function (data) {
                    console.log(data); // выводим ошибку в консоль
                }
            });
        } else {
            console.log('error');
            $('.fliter__checkbox').addClass('error');
        }
    });

})();
