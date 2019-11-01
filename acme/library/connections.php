<?php

/* 
Database connections
 */

function acmeConnect(){
$server = 'localhost';
$dbname= 'acme';
$username = 'iClient';
$password = 'aBbTQekO5eyE3xkz';
$dsn = "mysql:host=$server;dbname=$dbname";
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

// Create the actual connection object and assign it to a variable
try {
$db = new PDO($dsn, $username, $password, $options);
return $db;
} catch(PDOException $e) {
header('Location: /acme/view/500.php');
exit;
}
}






