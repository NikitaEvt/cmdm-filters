$(".home_slider").slick({
    accessibility: !0,
    dots: !1,
    centerMode: !0,
    centerPadding: "0",
    adaptiveHeight: !0,
    arrows: !0,
    prevArrow: '<button class="slick__slider-left slick__slider__btn"><img src="/assets/img/slider-left.svg" alt="left"></button>',
    nextArrow: '<button class="slick__slider-right slick__slider__btn"><img src="/assets/img/slider-right.svg" alt="right"></button>',
    responsive: [{
        breakpoint: 1480,
        settings: {slidesToShow: 1, slidesToScroll: 1, infinite: !0, centerMode: !1, dots: !1}
    }, {breakpoint: 1200, settings: {slidesToShow: 1, slidesToScroll: 1, dots: !1}}, {
        breakpoint: 991,
        settings: {slidesToShow: 1, arrows: !1, slidesToScroll: 1, arrows: !0, centerMode: !0, centerPadding: "0"}
    }, {
        breakpoint: 767,
        settings: {slidesToShow: 1, arrows: !0, slidesToScroll: 1, centerMode: !0, centerPadding: "0"}
    }, {
        breakpoint: 575,
        settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: !1,
            arrows: !0,
            prevArrow: '<button class="slick__slider-left slick__slider__btn"><img src="/assets/img/slider-left.svg" alt="left"></button>',
            nextArrow: '<button class="slick__slider-right slick__slider__btn"><img src="/assets/img/slider-right.svg" alt="right"></button>',
        }
    }]
});
$(".slider_nav").slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: ".home_slider",
    focusOnSelect: !0,
    arrows: !1,
    vertical: !0,
    adaptiveHeight: !0,
    accessibility: !0,
});
$(".product_featur").slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    focusOnSelect: !0,
    arrows: !0,
    prevArrow: '<button class="card-slider-left card-slider__btn"><img src="/assets/img/slider-left.svg" alt="left"></button>',
    nextArrow: '<button class="card-slider-right card-slider__btn"><img src="/assets/img/slider-right.svg" alt="left"></button>',
    accessibility: !0,
    touchThreshold: 100,
    responsive: [{breakpoint: 1300, settings: {arrows: !1, slidesToShow: 4, slidesToScroll: 1}}, {
        breakpoint: 900,
        settings: {arrows: !1, slidesToShow: 3, slidesToScroll: 1}
    }, {breakpoint: 700, settings: {arrows: !1, slidesToShow: 2, slidesToScroll: 1}}]
});
$(".category-col").slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    focusOnSelect: !0,
    arrows: !0,
    prevArrow: '<button class="card-slider-left card-slider__btn"><img src="/assets/img/slider-left.svg" alt="left"></button>',
    nextArrow: '<button class="card-slider-right card-slider__btn"><img src="/assets/img/slider-right.svg" alt="left"></button>',
    accessibility: !0,
    touchThreshold: 100,
    responsive: [{breakpoint: 1300, settings: {arrows: !1, slidesToShow: 4, slidesToScroll: 1}}, {
        breakpoint: 900,
        settings: {arrows: !1, slidesToShow: 2, slidesToScroll: 1}
    }, {breakpoint: 700, settings: {arrows: !1, slidesToShow: 2, slidesToScroll: 1}}]
});
$(".brand-col").slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    focusOnSelect: !0,
    arrows: !0,
    prevArrow: '<button class="card-slider-left card-slider__btn"><img src="/assets/img/slider-left.svg" alt="left"></button>',
    nextArrow: '<button class="card-slider-right card-slider__btn"><img src="/assets/img/slider-right.svg" alt="left"></button>',
    accessibility: !0,
    touchThreshold: 100,
    responsive: [{breakpoint: 1300, settings: {arrows: !1, slidesToShow: 4, slidesToScroll: 1}}, {
        breakpoint: 900,
        settings: {arrows: !1, slidesToShow: 3, slidesToScroll: 1}
    }, {breakpoint: 700, settings: {arrows: !1, slidesToShow: 2, slidesToScroll: 1}}]
});
$(".product_image_slider").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    focusOnSelect: !0,
    arrows: !0,
    prevArrow: '<button class="card-slider-left card-slider__btn"><img src="/assets/img/slider-left.svg" alt="left"></button>',
    nextArrow: '<button class="card-slider-right card-slider__btn"><img src="/assets/img/slider-right.svg" alt="left"></button>',
    accessibility: !0,
    touchThreshold: 100,
});
$("body").on("click",'.qty_minus', function () {
    var qty =  $('.qty_number').val();
    var minus = qty - 1;
    if (minus >= 1){
        $('.qty_number').val(minus);
        $('.qty_add').data('qty',minus);
    }
});
$("body").on("click",'.qty_plus', function () {
    var qty =  $('.qty_number').val();
    var plus = Number(qty) + 1;
    if (plus >= 1){
        $('.qty_number').val(plus);
        $('.qty_add').data('qty',plus);
    }
});
$("body").on("click",'.qty_minus_pr', function () {
    var product = $(this);
    var qty =  product.parent().children('.qty_number_pr').val();
    var rowid =  product.parent().children('.qty_number_pr').data('id');
    var minus = qty - 1;
    if (minus >= 1){
        product.parent().children('.qty_number_pr').val(minus);
        $.ajax({
            url: '/cart/update', // путь к обработчику
            type: 'POST', // метод отправки
            dataType: 'json',
            data: {rowid: rowid, quantity: minus},
            success: function (data) {
                $('.cart-price').html(data.cart_total + '<span class="currency"> €</span>');
                product.parent().parent().children('.total_pr').html(data.item.subtotal + '<span class="currency"> €</span>');
            },
            error: function (data) {
                console.log(data); // выводим ошибку в консоль
            }
        });
        return false;
    }
});
$("body").on("click",'.qty_plus_pr', function () {
    var product = $(this);
    var qty =  product.parent().children('.qty_number_pr').val();
    var rowid =  product.parent().children('.qty_number_pr').data('id');
    var plus = Number(qty) + 1;
    if (plus >= 1){
        product.parent().children('.qty_number_pr').val(plus);
        $.ajax({
            url: '/cart/update', // путь к обработчику
            type: 'POST', // метод отправки
            dataType: 'json',
            data: {rowid: rowid, quantity: plus},
            success: function (data) {
                $('.cart-price').html(data.cart_total + '<span class="currency"> €</span>');
                product.parent().parent().children('.total_pr').html(data.item.subtotal + '<span class="currency"> €</span>');
            },
            error: function (data) {
                console.log(data); // выводим ошибку в консоль
            }
        });
        return false;
    }
});
$('input[name="search"]').keyup(function(e) {
    e.preventDefault();
    var search = $('input[name="search"]').val();
    $.ajax({
        url: '/search_head', // путь к обработчику
        type: 'POST', // метод отправки
        dataType: 'html',
        data: {search:search},
        success: function (data) {
            if (data === '1'){
                $('.search__popup').hide('');
            }else{
                $('.search__popup').show();
                $('.search__popup').html(data);
            }

        },
        error: function (data) {
            console.log(data); // выводим ошибку в консоль
        }
    });
    return false;
});