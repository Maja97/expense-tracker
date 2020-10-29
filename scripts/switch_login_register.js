$(function() {

    $('#login-form-link').click(function(e) {
        $("#login-form").delay(100).fadeIn(100);
        $(".card-footer").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(0);
		$('#register-form-link').removeClass('active');
        $(this).addClass('active');
        $(".card").width("400px").height("410px");
        $(".input-group").width("auto");
		e.preventDefault();
	});
	$('#register-form-link, #regHere').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
         $("#login-form").fadeOut(0);
         $(".card-footer").fadeOut(0);
		$('#login-form-link').removeClass('active');
        $("#register-form-link").addClass('active');
        $(".card").width("520px").height("520px");
        $(".input-group").width("300px");
        $(".card-header").height("70px")
		e.preventDefault();
    });
});
