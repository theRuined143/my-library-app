<?php

    $index = $_POST["index"];
    $borrowedBy = $_POST["borrowedBy"];

    $conn = mysqli_connect("localhost","localhost","","thelibrary");
    if ($conn->connection_error) {
        die("Connection failed: " . $conn->connection_error);
    }
    $sql = "UPDATE file1 SET borrowed='".$borrowedBy."' WHERE ID=$index";

    $statement = $conn->query("SET NAMES 'utf8'");
    $statement = $conn->query("SET CHARACTER SET 'utf8'");
    
    $result = $conn->query($sql);

    if ($result===TRUE){
        echo "ΔΑΝΕΙΣΜΟΣ ΕΠΙΤΥΧΗΣ!";
  
      } else if ($result===FALSE){
        echo "ΣΦΑΛΜΑ ΔΑΝΕΙΣΜΟΥ!" . $conn->error;
      }
  
    $conn->close();
?>