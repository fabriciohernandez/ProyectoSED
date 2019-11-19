<?php

$server = 'localhost:3306';
$username = 'root';
$password = 'Server2019';
$database = 'db_jdz';

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}

?>
