<?php


// Let's connect to host
mysql_connect($GLOBALS['dbHost'], $GLOBALS['dbUserName'], $GLOBALS['dbPassword']) or DIE('Connection to host is failed, perhaps the service is down!');
// Select the database
mysql_select_db($GLOBALS['dbName']) or DIE('Database name is not available!');
?>
