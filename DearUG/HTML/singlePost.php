<?php // Initialize the session
  session_start();
?>

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
  // Establishing a connection to DB
  $dbhost = 'mysql:host=classdb.it.mtu.edu;port=3307;dbname=fisforsuccess';
  $dbuser = 'fisforsuccess_rw';
  $dbpass = 'success123';

  $id = $_SESSION['id'];

  try {
    $dbconnect = new PDO($dbhost, $dbuser, $dbpass);
  }
  catch (PDOException $error) {
    die("ERROR: " . $error . "<br/>");
  }

  // Individual post format.
  echo "<body class=\"post\">";
      // Loop and display each post in the main html. Note "as $row" , which is an array. $row[0] corresponds to the name, $row[1] correspond to date, etc etc...
      foreach($dbconnect->query("SELECT name, date, username, description, thumbsUp, thumbsDown, ID FROM post WHERE ID=$id") as $row) {
        // Formatting for new post. This is from the old post.html
        echo "<div class=\"w3-container w3-card w3-white w3-round w3-margin\"><br>";

        // Post title.
        echo "<h2>" .$row[0]. "</h2><br>";
        // Description
        echo "<h3>" .$row[3]. "</h3><br>";

        // "submitted by [username] on [date]"
        echo "<body>submitted by ".$row[2]." on ".$row[1]. "</body><br>";

        // Display a like and comment button below each post. This may need to change to give them unique IDs. We will find out soon.
        echo "<button type=\"button\" class=\"w3-button w3-theme-d1 w3-margin-bottom\"><i class=\"fa fa-thumbs-up\"></i>  Like</button>";
        echo "<a href='comment.php?id=$row[6]' target='_top'> <button type=\"button\" class=\"w3-button w3-theme-d2 w3-margin-bottom\"><i class=\"fa fa-comment\"></i>  Comment</button></a>";
        echo "</div>";
      }
      foreach($dbconnect->query("SELECT name, date, username, description, thumbsUp, thumbsDown, ID FROM comment WHERE postID=$id") as $row2) {
        echo "<div class=\"w3-container w3-card w3-white w3-round w3-margin\"><br>";

        // Post title.
        echo "<h3>" .$row2[0]. "</h3>";
        // Description
        echo "<p>" .$row2[3]. "</p>";

        // "submitted by [username] on [date]"
        echo "<body>submitted by ".$row2[2]." on ".$row2[1]. "</body><br>";

        // Display a like and comment button below each post. This may need to change to give them unique IDs. We will find out soon.
        echo "<button type=\"button\" class=\"w3-button w3-theme-d1 w3-margin-bottom\"><i class=\"fa fa-thumbs-up\"></i>  Like</button>";
        //echo "<a href='comment.php?id=$row2[6]' target='_top'> <button type=\"button\" class=\"w3-button w3-theme-d2 w3-margin-bottom\"><i class=\"fa fa-comment\"></i>  Comment</button></a>";
        echo "</div>";
      }

  echo "</body>";
?>




</html>
