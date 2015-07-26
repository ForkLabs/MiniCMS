<?php require(PROTECT);

	class view {
		# Loads view files, can pass an object with properties to use within the views file
		function load($view, $vars = null) {
			if(file_exists(VIEWS . $view . '.php')) {
				# We support variables to the views file with this
				if(!is_null($vars)) {
					$this->vars = $vars;
				} else {
					# make sure we can use this array
					$this->vars = new stdClass();
				}
				
				require(VIEWS . $view . '.php');
			} else {
				die(FATAL_ERROR_OPEN.'View file <b>'.$view.'</b> was not found, and cannot be loaded.'.FATAL_ERROR_CLOSE);
			}
		}
		
		# This function is specifically for returning merged objects for the view
		function mergeVars($stdClass, $vars) {
			$obj_merged = (object) array_merge((array) $stdClass, (array) $vars);
			return $obj_merged;
		}
	}
