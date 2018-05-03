<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'db.tropicjam.co.uk');
define('DB_USERNAME', 'jamie');
define('DB_PASSWORD', '8GYEKSpJMvwyc3rt');
define('DB_NAME', 'jamie');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>