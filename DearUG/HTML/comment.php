<?php // Initialize the session
  session_start();
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
<link rel="stylesheet" href="format.css">

  <body>
    <?php
        if(isset($_GET["id"])){
          $_SESSION["id"] = $_GET["id"];
        }
        //Specifies login information for the database
        $dbhost = 'mysql:host=classdb.it.mtu.edu;port=3307;dbname=fisforsuccess';
        $dbuser = 'fisforsuccess_rw';
        $dbpass = 'success123';

        //Attempts to connect to the database
        try {

          $dbconnect = new PDO($dbhost, $dbuser, $dbpass);


          //If the form is filled out, it pushes to database
            if(isset($_POST["title"]) && !empty($_POST["title"]) && isset($_POST["content"]) && !empty($_POST["content"])) {
              // If the username is NULL, take to the login page.
              if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
                $statement = $dbconnect -> prepare("CALL newComment(:name, :username, :description, :isEdited, :postID)");
                $result = $statement -> execute(array(':name'=> $_POST["title"], ':username' => $_SESSION["username"], ':description'=> $_POST["content"],
                ':isEdited' => 0, ':postID' => $_SESSION["id"]));
              } else {
                header("refresh:0;url=https://classdb.it.mtu.edu/cs3141/FisForSuccess/action.php");
                echo "<script>alert(\"Please login before posting a comment. Sending to the login page...\")</script>";
              }
            }
        }

        catch (PDOException $error) {
                die("ERROR: " . $error->getMessage() . "<br/>");

            }


    ?>

    <h1>Comments</h1>
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
    <!--iframe to display the post-->
    <span class='iframe-wrapper'><iframe id="myframe" src="singlePost.php" style="height:100%;width:100%;position:relative;"></iframe></span>
    <!--comment form-->
    <div class="form" style="width:35%;position:absolute;left:500px;">
      <form  method=post action="comment.php">
        <input type="text" id="title" name="title" placeholder="Title"><br/>
        <textarea id="content" name="content" rows="5" cols="75"></textarea><br/>
        <input type="submit" value="Submit">
      </form>
    </div>





  </body>
</html>
