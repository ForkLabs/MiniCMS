<?php require(PROTECT);
	/* 
	 *
	 *	This is the common functions file. This is the file where you
	 *	will define commonly used functions.
	 *
	 */

	function YU_redirect($REDIRECT_PATH) {
		if(!$REDIRECT_PATH)
				$REDIRECT_PATH = 'index';
		
			$YU_HOST  = $_SERVER['HTTP_HOST'];
			header("Location: http://".$YU_HOST."/".$REDIRECT_PATH);

			exit;
		
	}
	function redirect($path) {
		if(!$path)
				$path = '';
		
			$host  = $_SERVER['HTTP_HOST'];
			header("Location: http://".$host."/".$REDIRECT_PATH);
			exit;
	}
    function load_model($model) {
		require(MODELS . strtolower($model) . '.php');
		$model_name = 'models_'.ucfirst($model);
		
		$userdata = unserialize(USERDATA);
		return new $model_name($userdata);
	}
	function _cssSelect($dir)
	{
		/*if(file_exists(STYLE_CORE . 'clients/'. $dir . '/global.css'))
			echo $dir . " EXISTS";
		*/

	}
	
