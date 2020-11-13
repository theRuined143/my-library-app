<?php

    $index = $_POST["index"];
    $returnedBy = $_POST["returnedBy"];

    $conn = mysqli_connect("localhost","localhost","","thelibrary");
    if ($conn->connection_error) {
        die("Connection failed: " . $conn->connection_error);
    }
    $sql = "UPDATE file1 SET borrowed='ΟΧΙ' WHERE ID=$index";

    $statement = $conn->query("SET NAMES 'utf8'");
    $statement = $conn->query("SET CHARACTER SET 'utf8'");
    
    $result = $conn->query($sql);

    if ($result===TRUE){
        echo "ΕΠΙΣΤΡΟΦΗ ΕΠΙΤΥΧΗΣ!";
  
      } else if ($result===FALSE){
        echo "ΣΦΑΛΜΑ ΕΠΙΣΤΡΟΦΗΣ!" . $conn->error;
      }
  
    $conn->close();
?>