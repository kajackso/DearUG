<!DOCTYPE html>
<html>
<title>Post</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
</style>

<?php
  $dbhost = 'mysql:host=classdb.it.mtu.edu;port=3307;dbname=fisforsuccess';
  $dbuser = 'fisforsuccess_rw';
  $dbpass = 'success123';
  try {
    $dbconnect = new PDO($dbhost, $dbuser, $dbpass);
  }
  catch (PDOException $error) {
    die("ERROR: " . $error . "<br/>");
  }
  echo "<body class=\"post\">";
      // Loop and display each post in the main html.
      foreach($dbconnect->query("SELECT name, date, username, description, thumbsUp, thumbsDown FROM post") as $row) {
        // New divisor 
        echo "<div class=\"w3-container w3-card w3-white w3-round w3-margin\"><br>";
        echo "<h2>" .$row[0]. "</h2><br>";
        // Description
        echo "<h3>" .$row[3]. "</h3><br>";
        echo "<body>submitted by ".$row[2]." on ".$row[1]. "</body><br>";

        echo "<button type=\"button\" class=\"w3-button w3-theme-d1 w3-margin-bottom\"><i class=\"fa fa-thumbs-up\"></i>  Like</button>";
        echo "<button type=\"button\" class=\"w3-button w3-theme-d2 w3-margin-bottom\"><i class=\"fa fa-comment\"></i>  Comment</button>";
        echo "</div>";
      }
      // One Iteration
      // <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
      //   <!-- Display Username of Post Writer -->
      //   <h2>Funny Post Title! Haha!</h2><br>

      //   <body>submitted by testUser on 11/14/2020</body><br>


      //   <!-- Like Button -->
      //   <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Like</button>

      //   <!-- Comment Button -->
      //   <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i>  Comment</button>
      // </div>


  echo "</body>";
?>




</html>
