<?php // Initialize the session
  session_start();
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
<link rel="stylesheet" href="format.css">

  <body>
    <?php
    echo "wow";
        //session_start();

        //Specifies login information for the database
        $dbhost = 'mysql:host=classdb.it.mtu.edu;port=3307;dbname=fisforsuccess';
        $dbuser = 'fisforsuccess_rw';
        $dbpass = 'success123';

        //Attempts to connect to the database
        try {

          $dbconnect = new PDO($dbhost, $dbuser, $dbpass);


          //If the form is filled out, it pushes to database
            if(isset($_POST["title"]) || !empty($_POST["title"])) {
              echo " wesley ";
                $statement = $dbconnect -> prepare("CALL newComment(:name, :username, :description, :isEdited, :postID)");

                $result = $statement -> execute(array(':name'=> $_POST["title"], ':username' => $_SESSION["username"], ':description'=> $_POST["content"],
                ':isEdited' => 0, ':postID' => 0));
                  header("Location: https://classdb.it.mtu.edu/cs3141/FisForSuccess/Main.html");
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
    <form action="search.php">
      <input type="text" id="fname" name="fname" placeholder="Search">
      <input type="submit" value="Submit">
    </form>
    <a href="action.php" >Login</a>
    <a href="register.php">Register</a>
    </h2>
    <!--iframe to display the post-->
    <iframe id="myframe" src="post.php" style="height:100%;width:35%;position:absolute;top:150px;bottom:0px;left:500px;"></iframe>
    <!--comment form-->
    <div class="form">
      <form  method=post action="comment.php">
        <input type="text" id="title" name="title" placeholder="Title"><br/>
        <textarea id="content" name="content" rows="15" cols="25"></textarea><br/>
        <input type="submit" value="Submit">
      </form>
    </div>





  </body>
</html>
