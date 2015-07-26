<?php require(PROTECT);?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="robots" content="noindex" />

		<title>Administrator Login | TSS82 | MiniCMS</title>
		
		<script src="/assets/js/jquery-1.11.2.min.js"></script>
		<script src="/assets/js/auth.js"></script>
		<link type="text/css" rel="stylesheet" href="/assets/css/auth.css" />
	</head>
	<body>
		<div id="minicms-content">
			<div id="minicms-company_logo-wrap">
				<img src="/assets/img/forklabs_logo.png" alt="ForkLabs MiniCMS" title="ForkLabs | MiniCMS" />
			</div>
			<div id="minicms-login_form-wrap">
				<form id="minicms-login_form" method="post" action="/auth/login">
					<input type="text" name="username" id="minicms-login_form-username" title="Your Username" placeholder="Username" />
						<br />
					<input type="password" name="password" id="minicms-login_form-password" title="Your Password" placeholder="Password" />
						<br />
					<input id="minicms-login_form-token" name="token" type="hidden" value="<?=md5(time()+rand())?>" />
					<a id="minicms-login_form-submit_button" onClick="auth.submit_login();">Login</a>
				</form>
			</div>
		</div>
		<script>
			$( "#minicms-login_form-password" ).keypress(function( event ) {
			  if ( event.which == 13 ) {
			     auth.submit_login();
			  } else {
			  	console.log('Key was pressed just not enter.');
			  }
			});
		</script>
	</body>
</html>
