<?php
define('DBSERVER', 'localhost'); // Database server
define('DBUSERNAME', 'your_username'); // Database username
define('DBPASSWORD', 'your_password'); // Database password
define('DBNAME', 'your_database_name'); // Database name

// Connect to MySQL database
$db = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);

// Check connection
if ($db === false) {
    die("Error: connection error. " . mysqli_connect_error());
}
?>