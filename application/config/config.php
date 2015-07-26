<?php require(PROTECT);

 /*	-------------------------------------- *
  *		MiniMVC Configuration File		   *
  * -------------------------------------- */
  
	define('YU_PATH', '');
  
	# URI stuff
	
	define('DEFAULT_CONTROLLER', 'home');
	define('DEFAULT_METHOD', 'index');
	
	# Template stuff
	
	define('USING_TEMPLATE', 'default');
	define('TEMPLATES', APPLICATION_PATH . 'templates/');
	
	# DATABASE stuff
	
	$CONFIG_database = array(
		'host' => 'localhost',
		'user' => '',
		'password' => '',
		'database' => '',
		'enable' => TRUE
	);
	
	# Error Override
	define('YU_ERROR_OVERRIDE', false);
