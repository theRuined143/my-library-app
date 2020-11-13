<?php
$host = "localhost";
$user = "localhost";
$password = "";
$connection = mysqli_connect($host, $user, $password);
// Check connection
if ($connection->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
