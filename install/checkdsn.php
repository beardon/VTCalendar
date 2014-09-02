<?php

// Exit if the config file already exists.
if (file_exists('../config.inc.php')) exit();

// Include Pear::DB or output an error message if it does not exist.
@(include_once('DB.php')) or die('Pear::DB not installed.');
require_once('../functions-misc.inc.php');

if (isset($_GET['str']) && $_GET['str'] != "") {
	setVar($dsn,$_GET['str']);
	$connection = DB::connect($dsn);
	
	if (DB::isError($connection)) {
		echo "Failed: " . $connection->getMessage();
	}
	else {
		echo "Successfully connected to the database!";
	}
}
else {
	echo "The database connection string cannot be empty.";
}
?>