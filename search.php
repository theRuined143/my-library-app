<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
	
require_once "db.php";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Search Results</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  	<link rel="stylesheet" href="bLibrary.css">
  </head>
  <body>
    <table style="visibility:visible">
        <tr>
          <th>Κωδικός ID</th>
          <th>Όνομα</th>
          <th>Συγγραφέας</th>
          <th>Κατηγορία</th>
          <th>Ημ/νία Έκδοσης</th>
          <th>Εκδότης</th>
          <th>Θέση</th>
          <th>Διαχωρισμός</th>
        </tr>
          <th>Ιδιοκτήτης</th>
        <?php
          error_reporting(E_ALL ^ E_NOTICE);
          $conn = mysqli_connect($host, $user, $password, "Library");
          // Check connection
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          //$search_thing = $_GET['query']; to original

          $search[0] = $_GET['query'];
          $search[1] = $_GET['searchName'];
          $search[2] = $_GET['searchAuthor'];
          $search[3] = $_GET['searchCategory'];
          $search[4] = $_GET['searchPublisher'];
          $search[5] = $_GET['searchDate'];
          $search[6] = $_GET['searchPosition'];
          $search[7] = $_GET['searchSplitter'];
          $search[8] = $_GET['searchOwner'];

          $i=0;
          $search_thing = $search[0];
          for ($i =0; $i<=8; $i++){
            if ($search[$i]!="") {
              $search_thing = $search[$i];
            }
          }

          $search_thing = htmlspecialchars($search_thing);
      // changes characters used in html to their equivalents, for example: < to &gt;

          //$search_thing = mysql_real_escape_string($search_thing);
      // makes sure nobody uses SQL injection
          $sql = "SELECT * FROM file1 WHERE ((author LIKE '%".$search_thing."%') OR (category LIKE '%".$search_thing."%') OR (title LIKE '%".$search_thing."%') OR (publisher LIKE '%".$search_thing."%') OR (position LIKE '%".$search_thing."%') OR (owner LIKE '%".$search_thing."%'))";

          //necessary for greek characters to appear
          $st1 = $conn->query("SET NAMES 'utf8'");
          $st2 = $conn->query("SET CHARACTER SET 'utf8'");
          //$stmt = $dbConnection->prepare($sql);
          //$stmt->bind_param('s', $name);
          $result = $conn->query($sql);
          echo "<hr>";

          if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              echo "<tr><td>" . $row["ID"]. "</td><td>" . $row["title"] . "</td><td>"
              . $row["author"]. "</td><td>" . $row["category"] . "</td><td>" . $row["date"] . "</td><td>"
              . $row["publisher"] . "</td><td>" . $row["position"] . "</td><td>"
              . $row["splitter"] . "</td><td>" . $row["owner"] . "</td></tr>";
            }
          echo "</table>";
          } else { echo "0 results"; }
          $conn->close();
      ?>
    </table>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="bLibrary.js" charset="utf-8"></script>
  </body>
</html>
