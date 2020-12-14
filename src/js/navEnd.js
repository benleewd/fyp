if (!($(".btn-group button").length)){
    $('#indent').css('display', 'none');
} else {
    $('#empSidebar').hide();
}

$(".nav-link").click(function(e) {
    e.preventDefault();
})

$("#wrapper").addClass('toggled');
$("#menu-toggle").click(function(e) {
    e.stopPropagation();
    $("body").removeClass("preload");
    $("#wrapper").toggleClass("toggled");
});
$('body').click(function(e) {
    $("body").removeClass("preload");
    if (!$('#wrapper').hasClass('toggled')) {
        $("#wrapper").toggleClass('toggled');
    }
});
$('#indent a').click(function(e) {
    if (!$('#wrapper').hasClass('toggled')) {
        $("#wrapper").toggleClass('toggled');
    }
});
$('.btn-group button').click(function(e) {
    e.stopPropagation();
});

$('#empSidebar a').click(function(e){
    $(".btn-group button:first-child").removeClass("active");  
    $('.btn-group button:last-child').addClass("active");
});

$('.btn-group button:last-child').click(function(e) {
    $('#empSidebar').show();
    $('#indent').hide();
    $(".btn-group button:first-child").removeClass("active");  
    $('.btn-group button:last-child').addClass("active");
});

$('.btn-group button:first-child').click(function(e) {
    $('#empSidebar').hide();
    $('#indent').show();
    $(".btn-group button:last-child").removeClass("active");  
    $('.btn-group button:first-child').addClass("active");
});