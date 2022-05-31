// $(document).ready(function(){
//   $(".home-product-slider").slick({
//     slidesToShow: 4,
//     slidesToScroll: 1,
//   });

// });

$(document).ready(function(){  //дожидаемся загрузки страницы
  $('#click_btn').on("click", function(){  //вешаем событие на клик по кнопке
      $('#menu').toggle(); //включает/выключает элемент
  });
  $('#dropbtn').on("click", function(){  //вешаем событие на клик по кнопке
    $('#dropdown').toggle(); //включает/выключает элемент
});
$('.questions__acc-link').on('click', function (e) {
  e.preventDefault()
  $(this).toggleClass('questions__acc-link--active')
  $(this).children('.questions__acc-text').slideToggle()
});
$('.questions__acc-link').on('click', function (e) {
  e.preventDefault()
  $(this).addClass('bg-black');
});

/* Javascript */
$(function () {
  $("#rateYo").rateYo({
    starWidth: "30px"
  });
})

$('#click').on('click', function() {
$('#click').css('background', '#3597D0');
});
$('#click-2').on('click', function() {
$('#click-2').css('background', '#3597D0');
});
$('#click-3').on('click', function() {
$('#click-3').css('background', '#3597D0');
});
$('#click-4').on('click', function() {
$('#click-4').css('background', '#3597D0');
});
$('#click-5').on('click', function() {
$('#click-5').css('background', '#3597D0');
});
$('#click-6').on('click', function() {
$('#click-6').css('background', '#3597D0');
});
$('#click-7').on('click', function() {
$('#click-7').css('background', '#3597D0');
});
});