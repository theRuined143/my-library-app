<?php 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $change = $_POST["change"];
  if ($change=="yes"){

    error_reporting(E_ALL ^ E_NOTICE);
    $conn1 = mysqli_connect("localhost", "localhost", "", "thelibrary");
    // Check conn1ection
    if ($conn1->connect_error) {
      die("Connection failed: " . $conn1->connect_error);
    }

    $sql1 = "SELECT * FROM file1 ORDER BY ID DESC";
    //necessary for greek characters to appear
    $st1 = $conn1->query("SET NAMES 'utf8'");
    $st2 = $conn1->query("SET CHARACTER SET 'utf8'");
    //$stmt = $dbConnection->prepare($sql1);
    //$stmt->bind_param('s', $name);
    $result1 = $conn1->query($sql1);
    echo "<p>'%".$result1."%'</p>";

    if ($result1->num_rows > 0) {
      // output data of each row

      while($row = $result1->fetch_assoc()) {
        echo "<tr><td>" . $row["ID"]. "</td><td>" . $row["title"] . "</td><td>"
        . $row["author"]. "</td><td>" . $row["category"] . "</td><td>" . $row["date"] . "</td><td>"
        . $row["publisher"] . "</td><td>" . $row["position"] . "</td><td>"
        . $row["splitter"] . "</td><td>" . $row["owner"] . "</td></tr>";
      }
    } else { echo "0 results from fetch"; }
    $conn1->close();

  }
}
?>
