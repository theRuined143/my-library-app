<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>All the books</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  	<link rel="stylesheet" href="bLibrary.css">
  </head>
  <body>
    <div class="row2">
      <table>
        <tr>
          <th>Κωδικός ID</th>
          <th>Όνομα</th>
          <th>Συγγραφέας</th>
          <th>Κατηγορία</th>
          <th>Ημ/νία Έκδοσης</th>
          <th>Εκδότης</th>
          <th>Θέση</th>
          <th>Διαχωρισμός</th>
          <th>Ιδιοκτήτης</th>
        </tr>
        <?php
			error_reporting(E_ALL ^ E_NOTICE);
            $conn = mysqli_connect("localhost", "root", "", "thelibrary");
            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT * FROM file1 LIMIT 10";
			//necessary for greek characters to appear
			$st1 = $conn->query("SET NAMES 'utf8'");
			$st2 = $conn->query("SET CHARACTER SET 'utf8'");
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

    </div>
  </body>
</html>
