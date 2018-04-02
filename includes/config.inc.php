<?php

// Set Settings mode
define('_LIVE_MODE',FALSE);

if ( _LIVE_MODE ) {
	######################### Live Server Settings ##########################
	define('_MYSERVER','https://dev.marketheed.com');
	define('_MYSECURESERVER','localhost');
	define('_USER_NAME','behavi45_devmark');
	define('_USER_PASS','Welcome123!');
	define('_DB_NAME','behavi45_devmarketheed');
} else {
	######################### Local Settings ##########################
	define('_MYSERVER','https://dev.marketheed.com');
	define('_DB_HOST','localhost');
	define('_DB_USER','behavi45_devmark');
	define('_DB_PASS','Welcome123!');
	define('_DB_NAME','behavi45_devmarketheed');
}


?>