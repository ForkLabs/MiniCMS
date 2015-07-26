<?php	require(PROTECT);
	/*	-------------------------- 	*
	 *			MiniMVC				*
	 *		By ForkLabs, LLC.		*
	 *	--------------------------	*/
	
	/*	--------------------------	*
	 *		  Load Errors       	*
	 *	--------------------------	*/
	
	require(CORE_PATH . 'errors.php');
	 
	 
	/*	--------------------------	*
	 *		Global Variables       	*
	 *	--------------------------	*/
	require(CORE_PATH . 'public.php');
	
	 
	/*	--------------------------- *
	 *	Lets include our config		*
	 *	---------------------------	*/
	 require(CONFIG_PATH . 'config.php');
	 
	 /*	--------------------------- *
	 *	Lets require our constants		*
	 *	---------------------------	*/
	 require(CORE_PATH . 'constants.php');
	
	/*	---------------------------- *
	 *		Lets require our core	 *
	 *			  functions.		 *
	 *	---------------------------- */
	 require(CORE_PATH . 'common.php');
	 

	/*	---------------------------- *
	 *	LOAD THE LIBRARY CLASS 		 *
	 *	---------------------------- */
	 require(CORE_PATH . 'libraries.php');
	 $libraries = new Libraries();

	/*	---------------------------- *
	 *	AUTOLOADED LIBRARIES 		 *
	 *	---------------------------- */
	 require LIBRARIES . 'autoload.php';
	 //$autoload = new Autoload();
	
	/*	----------------------------- *
	 *	LOAD THE MODEL CLASS	 	  *
	 *	----------------------------- */
	 require(CORE_PATH . 'model.php');
	 
	 /*	--- Initialize Model --- */
	 	//$_MODEL = new Model(); 
	 /* ----------------------------- */
	
	
	/*	----------------------------- *
	 *	LOAD THE VIEW CLASS		  	  *
	 *	----------------------------- */
	 require(CORE_PATH . 'view.php');
	 
	 
	/*	---------------------------- *
	 *	LOAD TEMPLATE CLASS			 *
	 *	---------------------------- */
	 require(CORE_PATH . 'template.php');
	 
	 
	 /*	----------------------------- *
	 *	LOAD THE CONTROLLER CLASS NOW *
	 *	----------------------------- */
	 require(CORE_PATH . 'controller.php');
	
	 
	/*	---------------------------- *
	 *	   Lets process our URI		 *
	 *	---------------------------- */
	 require(LIBRARIES . 'uri.php');
	 $uri = new uri();

	$controller =  $uri->getURI('page');
	$method = $uri->getURI('action');
	$var = $uri->getURI('var');
	$args = $uri->getURI('args');
	
	# Lets find the requested Controller
	if(file_exists(CONTROLLERS . $controller . '.php'))
		require(CONTROLLERS . $controller . '.php');
	else
		die(FATAL_ERROR_OPEN.'Cannot find controller: <b>'.$controller.'</b>'.FATAL_ERROR_CLOSE);
	
	$rebuild_args = array();
	$x = 0;
	foreach($args as $arg) {
	    
		if($arg !== 'api' && $arg !== '' && $arg !== $controller &&  $arg !== $method) {
			$rebuild_args[$x] = $arg;
			$x++;
		}
	}
	empty($args);
	$args = $rebuild_args;
	
	
	# Assuming the script made it this far, create an instance of the requested controller
	$YU_CONTROLLER = new $controller();
	
	# Now lets check to see if the method exists in this Class 
	if(method_exists($YU_CONTROLLER, $method)) {
		call_user_func_array(array($YU_CONTROLLER, $method), $args);
	} else {
		if(YU_ERROR_OVERRIDE) {
			# Lets require the default controller
			$YU_DEFAULT_CONTROLLER_FILE = CONTROLLERS . DEFAULT_CONTROLLER . '.php';
			
			if(file_exists($YU_DEFAULT_CONTROLLER_FILE))
				require($YU_DEFAULT_CONTROLLER_FILE);
			else
				die(FATAL_ERROR_OPEN.'Cannot find <b>default</b> controller: <b>'.DEFAULT_CONTROLLER.'</b>'.FATAL_ERROR_CLOSE);
			
			$controller = DEFAULT_CONTROLLER;
			$YU_CONTROLLER = new $controller();

			call_user_func_array(array($YU_CONTROLLER, 'error_override'), $args);
		} else {
			echo FATAL_ERROR_OPEN."Method <b>'" . $method . "'</b> does not exist in class: <b>'" . $controller . "'</b>".FATAL_ERROR_CLOSE;
		}
	}
