<?php require(PROTECT);

/*	Load the following libraries */

$autoLoad_array = array(
	'database',
	'authlib'
	);

# We will reference this later to see what if any libraries were loaded
$autoLoaded_libraries = array();

if(count($autoLoad_array)) {
	$x = 0;
	foreach($autoLoad_array as $autoLoad_class) {
		# Does this classs even exist?
		if(file_exists(LIBRARIES . $autoLoad_class. '.php')) {
			require LIBRARIES . $autoLoad_class . '.php';

			# The class was loaded, lets toss the class name into an array
			$autoLoaded_libraries[$x] = $autoLoad_class;
			$x++;
		} else {
			echo ERROR_FATAL_OPEN."Could not load the library: <b>".$autoLoad_class."</b>".ERROR_FATAL_CLOSE;
		}
	}
}

# Define the AUTOLOADED_LIBRARIES constant
if(count($autoLoaded_array)) {
	$autoLoaded_array = implode(', ', $autoLoaded_array);
	define(AUTOLOADED_LIBRARIES, $autoLoaded_array);
} else {
	define(AUTOLOADED_LIBRARIES, false);
}
