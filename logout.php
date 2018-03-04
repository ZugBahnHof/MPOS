<?php
session_start();
session_destroy();
unset( $_SESSION['userid'] );

//Remove Cookies
setcookie( "identifier", "", time() - ( 3600 * 24 * 365 ) );
setcookie( "securitytoken", "", time() - ( 3600 * 24 * 365 ) );

require_once( "inc/config.inc.php" );
require_once( "inc/functions.inc.php" );

header( "Location: index.php?msg=Der+Logout+war+erfolgreich" );

