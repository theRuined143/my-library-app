<?php

  $server = "localhost";
  $dbusername = "localhost";
  $dbpassword = "";
  $db = "request";
  $dbconnect = mysqli_connect($server, $dbusername, $dbpassword, $db);
  // Check connection
  if ($dbconnect->connect_error) {
    die("Connection failed: " . $dbconnect->connect_error);
  }

  $request = $_GET('request');

  $sql = "INSERT INTO request.request (request) VALUES ('$request')";

  $result = $dbconnect->query($sql);

  ?>
