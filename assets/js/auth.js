/* -----------------
 *	Auth.JS
 * -----------------
 *
 * Author: 	Devontrae M. Walls
 * Company: ForkLabs, LLC | http://forklabsllc.com
 * Contact: contact@devontrae.com
 * For:		Tobacco Superstore #82
 *
 * --------------- */

 var Authenticate = function() {
 	// The constructor
 };

 Authenticate.prototype.submit_login = function() {
 	// Get the form data
 	var token_value = $('#minicms-login_form-token').val();
 	var username = $('#minicms-login_form-username').val();
 	var password = $('#minicms-login_form-password').val();

 	$.ajax({
	  type: "POST",
	  url: "/auth/login",
	  dataType: "json",
	  data: { username: username, password: password, token: token_value }
	})
	  .done(function( msg ) {
	    console.log( msg );
	    if(msg.status == 'SUCCESS') {
	    	console.log('Set the cookie');
	    	console.log('cookie: '+msg.cookie);
	    	document.cookie = msg.cookie;

	    	$('#minicms-content').animate({
			    top: "-=50",
			    opacity: 0
			  }, 250, function() {
			  	// We redirect here
			  	var origin = window.location.origin;
			  	var new_url = origin+'/';
			  	window.location = new_url;
			  });
	    } else {
	    	console.log('Login Failed.');
	    	$('#minicms-login_form-username').css('color', '#F05D5D');
	    	$('#minicms-login_form-password').css('color', '#F05D5D');
	    	 var speed = 50;
	    	 var content = '#minicms-content';

	    	 $(content).animate({
			    left: "+=10",
			  }, speed, function() {
			  	$(content).animate({
				    left: "-=10",
				  }, speed, function() {
				    $(content).animate({
					    left: "+=10",
					  }, speed, function() {
					  	$(content).animate({
						    left: "-=10",
						  }, speed, function() {
						    // Animation complete.
						    setTimeout(function() {
						    	$('#minicms-login_form-username').css('color', '#8AB85B');
	    						$('#minicms-login_form-password').css('color', '#8AB85B');
						    }, 300);
						  });
					  });
				  });
			  });
	    }
	  });
 };

 Authenticate.prototype.destroy_session = function() {
 	$.get('/auth/logout', function(data) {
 		// We use the data as the new cookie
 		document.cookie = data;
 	});
 };

 var auth = new Authenticate();
