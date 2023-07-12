<?php
//confuguration for database
$host = 'localhost';
$userName = 'root';
$password = 'Password1$#';
$db = 'amrit_drugs';

$connection = new mysqli($host, $userName, $password, $db);

if ($connection->connect_error) {
  die("Connection Error: " . $connection->connect_error);
}
