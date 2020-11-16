<!DOCTYPE html>

<html lang="en" dir="ltr">
<link rel="stylesheet" href="format.css">

  <body>


    <h1>New Post</h1>
    <h2>
      <a href="Main.html">Home</a>
      <a href="createPost.html">New</a>
      <a href="Tags.html">Tags</a>
      <form action="search.php">
        <input type="text" id="fname" name="fname" placeholder="Search">
        <input type="submit" value="Submit">
      </form>
      <a href="logintest.html">Login</a>
      <a href="register.php">Register</a>
    </h2>

    <div class="form">
      <form action="createPost.html">
        <input type="text" id="title" name="title" placeholder="Title"><br/>
        <textarea id="content" name="content" rows="15" cols="75"></textarea><br/>
        <input type="submit" value="Submit">
      </form>
    </div>

<?php

    $dbhost = 'mysql:host=classdb.it.mtu.edu;port=3307;dbname=fisforsuccess';
    $dbuser = 'fisforsuccess_rw';
    $dbpass = 'success123';

    try {
      $dbconnect = new PDO($dbhost, $dbuser, $dbpass);

      $title = $_POST["title"];
      $content = $_POST["content"];
      $date = strtotime(time, now);
      //echo "Created date is " . date("Y-m-d h:i:sa", $date);

      /* $statement = $dbconnect -> prepare("CALL newPost(:ID, :name, :description, :isEdited, :username, :isArchived)");
      $result = $statement -> execute(array(':ID' => ,':name'=> $title, ':description'=>$content, ':isEdited' => ,
        ':username' => , ':isArchived' =>));
      header("Location: https://classdb.it.mtu.edu/cs3141/FisForSuccess/Login.html"); */

    }


    catch (PDOException $error) {
            die("ERROR: " . $error->getMessage() . "<br/>");

        }

?>



  </body>
</html>
