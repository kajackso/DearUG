<?php // Initialize the session
  session_start();
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
<link rel="stylesheet" href="format.css">

  <body>
    <?php
        //Specifies login information for the database
        $dbhost = 'mysql:host=classdb.it.mtu.edu;port=3307;dbname=fisforsuccess';
        $dbuser = 'fisforsuccess_rw';
        $dbpass = 'success123';

        //Attempts to connect to the database
        try {
          $dbconnect = new PDO($dbhost, $dbuser, $dbpass);

          //If the form is filled in when the page loads, this pushes the content to the database
            if(isset($_POST["title"]) && !empty($_POST["title"]) && isset($_POST["content"]) && !empty($_POST["content"])) {
              if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
                $statement = $dbconnect -> prepare("CALL newPost(:name, :description, :isEdited, :username, :isArchived)");
                $result = $statement -> execute(array(':name'=> $_POST["title"], ':description'=> $_POST["content"], ':isEdited' => 0,
                ':username' => $_SESSION["username"], ':isArchived' => 0));
                header("Location: https://classdb.it.mtu.edu/cs3141/FisForSuccess/Main.html");
              } else {
                header("refresh:0;url=https://classdb.it.mtu.edu/cs3141/FisForSuccess/action.php");
                echo "<script>alert(\"Please login before creating a post. Sending to the login page...\")</script>";
              }
            }
        }
        catch (PDOException $error) {
                die("ERROR: " . $error->getMessage() . "<br/>");

            }
    ?>

    <h1>New Post</h1>
    <!--Banner, links to other pages -->
    <h2>
    <a href="Main.html">Home</a>
    <a href="new.php">New</a>
    <form method=post action="search.php">
      <input type="text" id="fname" name="fname" placeholder="Search">
      <input type="submit" value="Submit">
    </form>
    <a href="action.php" >Login</a>
    <a href="destroy.php" >Logout</a>
    <a href="register.php">Register</a>
    </h2>
    <!-- Here is a form, That takes in a post title and content to create a post in the database-->
    <div class="form">
      <form  method=post action="new.php">
        <input type="text" id="title" name="title" placeholder="Title"><br/>
        <textarea id="content" name="content" rows="15" cols="75"></textarea><br/>
        <input type="submit" value="Submit">
      </form>
    </div>





  </body>
</html>
