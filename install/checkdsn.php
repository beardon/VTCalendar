<?php

// Exit if the config file already exists.
if (file_exists('../config.inc.php')) exit();

// Include Pear::DB or output an error message if it does not exist.
@(include_once('DB.php')) or die('Pear::DB not installed.');

if (isset($_GET['str']) && $_GET['str'] != "") {
	$connection = DB::connect( $_GET['str'] );
	
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