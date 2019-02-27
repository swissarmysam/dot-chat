<?php 
// This file holds the database connection information
// it also establishes a connection to the database

// Connection code reference https://www.cloudways.com/blog/connect-mysql-with-php/

function openConnection() {
	$DB_SERVER = 'localhost'; // server name
	$DB_USER = 'xxx'; // user name
	$DB_PW = 'xxx'; // database password
	$DB_NAME = 'xxx'; // database name
	
	// create a new connection to the database or terminate if unsuccessful using OOP construct
	$connection = new mysqli($DB_SERVER, $DB_USER, $DB_PW, $DB_NAME) or die("Connection failed: %s\n" . $connection -> error); //%s placeholder for error

	return $connection; 
}

function closeConnection($connection) {
	$connection -> close(); // assign close() to be able to call and close database connection
}
 
?>