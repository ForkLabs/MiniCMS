<?php require(PROTECT);

	class Libraries {
		function libraries() {
			/*if(file_exists(LIBRARIES . 'autoload.php'))
				require LIBRARIES . 'autoload.php';
			*/
		}
		function load($library) {
			if(file_exists(LIBRARIES . $library . '.php')) {
				require LIBRARIES . $library . '.php';
				new $library();
			} else {
				echo ERROR_FATAL_OPEN."Library: <b>".$library."</b> not found.".ERROR_FATAL_CLOSE;
			}
		}
	}
