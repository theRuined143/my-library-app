
<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>The Library Application</title>
    <link rel="shortcut icon" type="image/x-icon" href="/thelibrary.ico"/>


    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bLibrary.css">

  </head>
  <!-- This whole thing is working and is going live soon -->
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

      <a class="navbar-brand" href="/MainLib/bLibrary.php">
      <img src="/images/warehouse-images/PlatformLogoSmall.png" width="30" height="30" class="d-inline-block align-top" alt="">
      B&T COMPOSITES
      </a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <button type='button' class='nav-link n-dark' id="stk" onclick='window.location.replace("/MainLib/bLibrary.php");'>ΒΙΒΛΙΟΘΗΚΗ</button>
        </li>
        <li class="nav-item">
          <button type='button' class='nav-link n-dark' id="stk" onclick='window.location.replace("/MainLib/logout.php");'>LOG OUT</button>
        </li>

      </ul>
    </div>
  </nav>
      <!-- SHOW WHICH USER IS ON -->
      <?php
      if(!isset($_SESSION['user'])){
        $x = $_SESSION['username'];
        echo "<p><h2 style='background-color:#588C7E; text-align:center' id='title1'>Welcome " .  $x . "</h2></p>";
        echo "<p id='theSession' style='display:none'>" .  $x . "</p>";
      }
    ?>
    <div class="topTop">

<div class="topnav">
        <div class="forma">
          <div class="logot">
            <img src="LogoLibrary.png" alt="our-logo" id="libLogo">
          </div>
          <form method="post">
            <input type="text" placeholder="Search Anything" name="query" />
            <input type="submit" name="Search" value="Search" />
          </form>
        </div>
        <div style="text-align:left">
          <label for="searchMore" class="modTextlef">MORE SEARCH OPTIONS:</label>
          <input type="checkbox" id="searchMore">
        </div>
        <div class="imFormDiv container" style="display : none">
        <br>
        <br>
            <div class="column1">
              <div class="search-container">
                <form method="post">
                  <input type="text" placeholder="Search Name" name="searchName">
                  <input type="submit" name="SearchN" value="Search" />
                </form>
              </div>
            </div>

            <div class="column2">
              <div class="search-container">
                <form method="post">
                  <input type="text" placeholder="Search Author" name="searchAuthor">
                  <input type="submit" name="SearchA" value="Search" />
                </form>
              </div>
            </div>

            <div class="column3">
              <div class="search-container">
                <form method="post">
                  <input type="text" placeholder="Search Category" name="searchCategory">
                  <input type="submit" name="SearchC" value="Search" />
                </form>
              </div>
            </div>

            <div class="column4">
              <div class="search-container">
                <form method="post">
                  <input type="text" placeholder="Search Publish Date" name="searchDate">
                  <input type="submit" name="SearchD" value="Search" />
                </form>
              </div>
            </div>

            <div class="column5">
              <div class="search-container">
                <form method="post">
                  <input type="text" placeholder="Search Publisher" name="searchPublisher">
                  <input type="submit" name="SearchP" value="Search" />
                </form>
              </div>
            </div>

            <div class="column6">
              <div class="search-container">
                <form method="post">
                  <input type="text" placeholder="Search Position" name="searchPosition">
                  <input type="submit" name="SearchPos" value="Search" />
                </form>
              </div>
            </div>

            <div class="column7">
              <div class="search-container">
                <form method="post">
                  <input type="text" placeholder="Search Splitter" name="searchSplitter">
                  <input type="submit" name="SearchS" value="Search" />
                </form>
              </div>
            </div>

            <div class="column8">
              <div class="search-container">
                <form method="post">
                  <input type="text" placeholder="Search Owner" name="searchOwner">
                  <input type="submit" name="SearchO" value="Search" />
                </form>
              </div>
           </div>
        </div>
      </div>
    </div>
    <hr class="split1">
    <div class="container-fluid">
      <div class="row">
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
              <img id="imLib" src="libW.jpg" alt="library-whole" width="500" height="400">
          </div>
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <table id="tableData">
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
                <th>Δανεισμένο</th>
              </tr>
              <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if(isset($_POST["SearchC"])){

                      $search_thing = $_POST['searchCategory'];
                      $col = 'category';

                    } else if(isset($_POST["SearchN"])){

                      $search_thing = $_POST['searchName'];
                      $col = 'title';

                    } else if(isset($_POST["SearchA"])){

                      $search_thing = $_POST['searchAuthor'];
                      $col = 'author';

                    } else if(isset($_POST["SearchP"])){

                      $search_thing = $_POST['searchPublisher'];
                      $col = 'publisher';

                    } else if(isset($_POST["SearchD"])){

                      $search_thing = $_POST['searchDate'];
                      $col = 'dateOfPub';

                    } else if(isset($_POST["SearchPos"])){

                      $search_thing = $_POST['searchPosition'];
                      $col = 'position';

                    } else if(isset($_POST["SearchS"])){

                      $search_thing = $_POST['searchSplitter'];
                      $col = 'splitter';

                    } else if(isset($_POST["SearchO"])){

                      $search_thing = $_POST['searchOwner'];
                      $col = 'owner';

                    } else if (isset($_POST["Search"])){
                      $search_thing = $_POST['query'];
                      $col = 'other';
                    }
                    $i = 0;
                    error_reporting(E_ALL ^ E_NOTICE);
                    $conn = mysqli_connect("localhost", "pi", "wov77buh", "thelibrary");
                    // Check connection
                    if ($conn->connect_error) {
                      die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM file1 WHERE (".$col." collate utf8_general_ci  LIKE '%".$search_thing."%')";
                    //necessary for greek characters to appear
                    $st1 = $conn->query("SET NAMES 'utf8'");
                    $st2 = $conn->query("SET CHARACTER SET 'utf8'");

                    if ($col=='other') {
                      $sql = "SELECT * FROM file1 WHERE ((author LIKE '%".$search_thing."%') OR (category LIKE '%".$search_thing."%') OR (title LIKE '%".$search_thing."%') OR (publisher LIKE '%".$search_thing."%') OR (position LIKE '%".$search_thing."%') OR (owner LIKE '%".$search_thing."%'))";
                    }
                    $result = $conn->query($sql);
			          ?>
                <style type="text/css">
                    table {
                        visibility:visible;
                        display:initial;
                    }
                </style>
                <?php

                  if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                      if($row["borrowed"]!=="ΟΧΙ"){
                        echo "<tr bgcolor='red' style='cursor:grab'><td>" . $row["ID"]. "</td><td>" . $row["title"] . "</td><td>"
                        . $row["author"]. "</td><td>" . $row["category"] . "</td><td>" . $row["dateOfPub"] . "</td><td>"
                        . $row["publisher"] . "</td><td>" . $row["position"] . "</td><td>"
                        . $row["splitter"] . "</td><td>" . $row["owner"] . "</td><td>" . $row["borrowed"] . "</td></tr>";
                      }else{
                        echo "<tr style='cursor:grab'><td>" . $row["ID"]. "</td><td>" . $row["title"] . "</td><td>"
                        . $row["author"]. "</td><td>" . $row["category"] . "</td><td>" . $row["dateOfPub"] . "</td><td>"
                        . $row["publisher"] . "</td><td>" . $row["position"] . "</td><td>"
                        . $row["splitter"] . "</td><td>" . $row["owner"] . "</td><td>" . $row["borrowed"] . "</td></tr>";
                      }

                    }
                  echo "</table>";
                  } else { echo "0 results"; }
                  $conn->close();
                  $_SESSION["result"] = $row;
            } else {
                error_reporting(E_ALL ^ E_NOTICE);
                $conn1 = mysqli_connect("localhost", "pi", "wov77buh", "thelibrary");
                // Check conn1ection
                if ($conn1->connect_error) {
                  die("Connection failed: " . $conn1->connect_error);
                }

                $sql1 = "SELECT * FROM file1";
                //necessary for greek characters to appear
                $st1 = $conn1->query("SET NAMES 'utf8'");
                $st2 = $conn1->query("SET CHARACTER SET 'utf8'");
                //$stmt = $dbConnection->prepare($sql1);
                //$stmt->bind_param('s', $name);
                $result = $conn1->query($sql1);
                //$ch = $_POST["change"];
                if (isset($_POST["check"])){
                  //$_SESSION['check'] = $_POST["check"];
                  $_SESSION['check'] = $_POST["check"];
                  echo $_SESSION['check'];
                }

                  $result1 = $result;

                  if ($result1->num_rows > 0) {
                  // output data of each row

                  while($row = $result1->fetch_assoc()) {
                    echo "<tr style='cursor:grab'><td>" . $row["ID"]. "</td><td>" . $row["title"] . "</td><td>"
                    . $row["author"]. "</td><td>" . $row["category"] . "</td><td>" . $row["dateOfPub"] . "</td><td>"
                    . $row["publisher"] . "</td><td>" . $row["position"] . "</td><td>"
                    . $row["splitter"] . "</td><td>" . $row["owner"] . "</td><td>" . $row["borrowed"] . "</td></tr>";
                  }
                  } else { echo "0 results from fetch"; }
                  $conn1->close();
	}
        ?>
            </table>
          </div>
      </div>
    </div>

    <!-- <div class="row">

      <hr>
      <hr>
      <hr>

    </div> -->
    <div id="show_data_Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" style="color:black">ΔΑΝΕΙΣΜΟΣ / ΕΠΙΣΤΡΟΦΗ</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <div class="modal-body">
          <form id="newForm" method="post">
          <div class="form-element" style="display: inline-block; width: 460px;">
              <label for="getID" class="modTextlef">ID:</label>
              <input type="text" id="getID" name="getID" class="modText">
            </div>
            <div class="form-element" style="display: inline-block; width: 460px;">
              <label for="getTitle" class="modTextlef">Τίτλος:</label>
              <input type="text" id="getTitle" name="getTitle" class="modText">
            </div>
            <div class="form-element" style="display: inline-block; width: 460px;">
              <label for="getAuthor" class="modTextlef">Συγγραφέας:</label>
              <input type="text" id="getAuthor" name="getAuthor" class="modText">
            </div>
            <div class="form-element" style="display: inline-block; width: 460px;">
              <label for="getCategory" class="modTextlef">Κατηγορία:</label>
              <input type="text" id="getCategory" name="getCategory" class="modText">
            </div>
            <div class="form-element" style="display: inline-block; width: 460px;">
              <label for="getDateOfPub" class="modTextlef">Ημ/νία:</label>
              <input type="text" id="getDateOfPub" name="getDateOfPub" class="modText">
            </div>
            <div class="form-element" style="display: inline-block; width: 460px;">
              <label for="getPublisher" class="modTextlef">Εκδότης:</label>
              <input type="text" id="getPublisher" name="getPublisher" class="modText">
            </div>
            <div class="form-element" style="display: inline-block; width: 460px;">
              <label for="getPosition" class="modTextlef">Θέση:</label>
              <input type="text" id="getPosition" name="getPosition" class="modText">
            </div>
            <div class="form-element" style="display: inline-block; width: 460px;">
              <label for="getSplitter" class="modTextlef">Διαχωρισμός:</label>
              <input type="text" id="getSplitter" name="getSplitter" class="modText">
            </div>
            <div class="form-element" style="display: inline-block; width: 460px;">
              <label for="getOwner" class="modTextlef">Ιδιοκτήτης:</label>
              <input type="text" id="getOwner" name="getOwner" class="modText">
            </div>
            <div class="form-element" style="display: inline-block; width: 460px;">
              <label for="getBorrower" class="modTextlef">Δανεισμένο:</label>
              <input type="text" id="getBorrower" name="getBorrower" class="modText">
            </div>
          </form>
          <form id="newDataForm" method="post">
            <input type="submit" value="ΔΑΝΕΙΣΜΟΣ" class="n n-primary up" id="borrow"/>
            <input type="submit" value="ΕΠΙΣΤΡΟΦΗ" class="n n-primary n-danger del" id="return"/>
          </form>
        </div>
        <div class="modal-footer">
          <!-- onClick="insertNew() -->
          <button type="button" class="n n-secondary" data-dismiss="modal" style="align:center">Close</button>
        </div>
    </div>
  </div>
  </div>

  </body>
</html>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="bLibrary.js" charset="utf-8"></script>
<script>

$("tr").on("click",function () {
  var matID = [];
     var row = this;
    //  var row = $(this);
     var i;
     for(i=0;i<=9;i++){
       // alert("this");
      //  matID[i] = row.childNodes[i].innerHTML;
      matID[i] = row.childNodes[i].innerHTML;
      console.log(matID[i]);
     }
     //give the data of the row to the inserts of the data modal
     $("#getID").val(matID[0]);
     $('#getTitle').val(matID[1]);
     $('#getAuthor').val(matID[2]);
     $('#getCategory').val(matID[3]);
     $('#getDateOfPub').val(matID[4]);
     $('#getPublisher').val(matID[5]);
     $('#getPosition').val(matID[6]);
     $('#getSplitter').val(matID[7]);
     $('#getOwner').val(matID[8]);
     $('#getBorrower').val(matID[9]);
     localStorage.setItem("thisRow",this.childNodes[0].innerHTML);
    $("#show_data_Modal").modal('show');
  });

  $('#borrow').on("click",function (e) {
    e.preventDefault();
    var ses;
    // ses = $("#theSession").val();
    ses = $("#theSession").text();
    alert("BORROW : " + localStorage.getItem("thisRow") + " by "+ ses);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == XMLHttpRequest.DONE) {
          alert(xmlhttp.responseText);
      }
    };
    //canned procedure of sending data to php
    xmlhttp.open("POST", "borrowABook.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var params = "index="+localStorage.getItem("thisRow")+"&borrowedBy="+encodeURIComponent(ses);
    xmlhttp.send(params);
    setTimeout(function(){ window.location.reload(); }, 1000);
  });
  $('#return').on("click",function (e) {
    e.preventDefault();
    var ses;
    ses = $("#theSession").text();
    alert("REUTURN : " + localStorage.getItem("thisRow"));
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == XMLHttpRequest.DONE) {
          alert(xmlhttp.responseText);
      }
    };
    //canned procedure of sending data to php
    xmlhttp.open("POST", "returnABook.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var params = "index="+localStorage.getItem("thisRow")+"&returnedBy="+encodeURIComponent(ses);
    xmlhttp.send(params);
    setTimeout(function(){ window.location.reload(); }, 1000);
  });
</script>
