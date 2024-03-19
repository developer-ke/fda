//$(".btn-deactivate-carousel").hover(function() {
//    
//    $(this).removeClass("btn-success");
//    $(this).addClass("btn-danger");
//    $(this).html('Deactivate');
//}, function () {
//    $(this).removeClass("btn-danger");
//    $(this).addClass("btn-success");
//    $(this).html('Active');
//});

$(".btn-deactivate-carousel").click(function(){
	$('#deactivate').appendTo("body");
    var carouselContentID = $(this).data('carouselcontentid');
    var carouselContentStatus = $(this).data('carouselcontentstatus');
    if(carouselContentStatus ==1){
    	$(".modal-body").empty();
    	$(".modal-body").append("<p>Are you sure you want to deactivate this Carousel Item?</p>");
    	$('.carouselButton').text("Deactivate");
    } else {
    	$(".modal-body").empty();
    	$(".modal-body").append("<p>Are you sure you want to activate this Carousel Item?</p>");
    	$('.carouselButton').text("Activate");
    }
    $('input[name="carouselContentID"]').val(carouselContentID);
});