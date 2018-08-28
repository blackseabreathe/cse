//вьюпорт чекер
$(document).ready(function(){
$('.go-down h1').viewportChecker({
classToAdd: 'fadeInRight2',
offset:0});
$('.docDev').viewportChecker({
classToAdd: 'fadeInTop2',
offset:0});
$('.go-down button').viewportChecker({
classToAdd: 'fadeInTop3',
offset:0});
$('#box1 .gridAllWidth.firstGrid').viewportChecker({
classToAdd: 'fadeInTopNew visible',
offset:100});
$('#box4 .gridFirstGrid').viewportChecker({
classToAdd: 'fadeInTop visible',
offset:100});
$('#box1 .headline').viewportChecker({
classToAdd: 'fadeInLeft visible',
offset:100});
$('#box2 .headline').viewportChecker({
classToAdd: 'visible',
offset:100});
$('#box4 .headline, #box4 .hasBeenDelivered').viewportChecker({
classToAdd: 'fadeInTop visible',
offset:100});
$('#box3 .gridAllWidth').viewportChecker({
classToAdd: 'fadeInRight visible',
offset:100});
$('.orange-block').viewportChecker({
classToAdd: 'fadeInRight visible',
offset:100});
$('.kse-box').viewportChecker({
classToAdd: 'fadeInTop95 visible',
offset:100});
$('.gridFaq_2 .col5:last').addClass('hidden').viewportChecker({
classToAdd: 'fadeInTop visible',
offset:100});  
$('.col6.mojave').viewportChecker({
classToAdd: 'fadeInRight visible',
offset:100});  
$('.contacts').viewportChecker({
classToAdd: 'fadeInTop visible',
offset:100});});
//вызываем feedback
$(document).on('click', '.modal_btn', function(){
$('#small-modal').arcticmodal();});
$(document).ready(function(){
//карусель цен
$('.carousel-price').owlCarousel({
loop:true,
margin:27,
nav:true,
dots:true,
items:3,
responsive:{
0:{items:1,nav:false},
480:{items:1},
768:{items:2},
970:{items:3}}});
//карусель отзывы
$('.carousel-testimonials').owlCarousel({
loop:true,
margin:33,
nav:true,
dots:true,
items:2,
responsive:{
0:{items:1,nav:false},
480:{items:1},
768:{items:1},
970:{items:2}}});
// checkbox и disabled
$('.form-1 .check').prop('checked', true);
$('.form-1 .feedback').prop('disabled', false);
$('.form-1 .check').change(function(){
$('.form-1 .feedback').prop('disabled', function(i, val) {
return !val;})});
$('.form-2 .check').prop('checked', true);
$('.form-2 .feedback').prop('disabled', false);
$('.form-2 .check').change(function(){
$('.form-2 .feedback').prop('disabled', function(i, val) {
return !val;})});
//раскрывающийся список
$('.col5, .arrow-up').click(function(){
$(this).find('.answer').slideToggle(300);
$(this).find('.arrow-up').toggleClass('arrow-reverse');});});
//затемнение и модальные окна
$('.whereIsMySending').on('click', function(){
$('.dark-bg, .popup_container').fadeIn(300);
$('body').addClass('no-scroll').removeClass('yes-scroll');
$('#typeNumberHere').focus();});
$('.to-close-modal, .modal-close-2').on('click', function(){
$('.dark-bg, .popup_container').fadeOut(300);
$('body').removeClass('no-scroll').addClass('yes-scroll');});
//промокод
$('.off2, .getPromocode').on('click',function(){
$('.dark-bg, .popup_container_2').fadeIn(300);
$('body').addClass('no-scroll').removeClass('yes-scroll');});
$('.to-close-modal, .modal-close-2').on('click', function(){
$('.dark-bg, .popup_container_2').fadeOut(300);
$('body').removeClass('no-scroll').addClass('yes-scroll');});
//вводим только цифры в инпутах калькулятора
$('.what-to-send input').on('keydown', function(e){
if(e.key.length == 1 && e.key.match(/[^0-9'".]/)){
return false;
};})
$('.calcPageBtn').on('click', function(){
$('.holder').fadeIn(600);});
//карта гугл 57.627412, 39.858403
google.maps.event.addDomListener(window, 'load', init);  
function init() {
var mapOptions = {
disableDefaultUI: true,
zoom: 17,
center: new google.maps.LatLng(57.627455, 39.855203),
styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#0e2241"}]},{"featureType":"landscape.man_made","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#8388ab"}]},{"featureType":"landscape.man_made","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#bcbcbc"}]},{"featureType":"landscape.man_made","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural.landcover","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#bcbcbc"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#111628"},{"lightness":21},{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#1c3457"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#6a6969"}]},{"featureType":"road.arterial","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#1c3457"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#6a6969"}]},{"featureType":"road.local","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#0f252e"},{"lightness":17}]}]};
var mapElement = document.getElementById('map');
var image = 'http://cse-yar.ru/img/marker.png';
var map = new google.maps.Map(mapElement, mapOptions);
var marker = new google.maps.Marker({
position: new google.maps.LatLng(57.626955, 39.858303),
map: map,
title: 'Здесь мы',
icon: image});}