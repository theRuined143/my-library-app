<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>

  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title>Error</title>
    </head>
    <body>
      <div class="form">
        <h1>Error</h1>
        <p>
          <?php
          if (isset($_SESSION['message']) AND !empty($_SESSION['message'])):
            echo $_SESSION['message'];
          else:
              header("location: index.php");
          endif;
          ?>

        </p>
        <a href="index.php"><button class="button button-block">Home</button></a>
      </div>
    </body>
  </html>
