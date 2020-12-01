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
          echo "cool";
          $dbconnect = new PDO($dbhost, $dbuser, $dbpass);
          if ($dbconnect) {
            echo "help";
          }
          //Creating the variables to be used
          // $title = $_POST["title"];
          // $content = $_POST["content"];
          //$username = $_SESSION["username"]; //Will change to match logged in profile if website is not logged in
          //if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
              //echo "Favorite animal is " . $_SESSION["username"] . ".";


          //$date = strtotime(time, now);
          //echo "Created date is " . date("Y-m-d h:i:sa", $date);
          //Posting nformation to database using newPost() method
          
            if(isset($_POST["title"]) || !empty($_POST["title"])) {
              echo " wesley ";
                $statement = $dbconnect -> prepare("CALL newPost(:name, :description, :isEdited, :username, :isArchived)");
                // $result = $statement -> execute(array(':name'=> $title, ':description'=>$content, ':isEdited' => 0,
                //   ':username' => $username, ':isArchived' => 0));
                $result = $statement -> execute(array(':name'=> $_POST["title"], ':description'=> $_POST["content"], ':isEdited' => 0,
                ':username' => $_SESSION["username"], ':isArchived' => 0));
                  header("Location: https://classdb.it.mtu.edu/cs3141/FisForSuccess/Main.html");
            }

        //}
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

    <div class="form">
      <form  method=post action="new.php">
        <input type="text" id="title" name="title" placeholder="Title"><br/>
        <textarea id="content" name="content" rows="15" cols="75"></textarea><br/>
        <input type="submit" value="Submit">
      </form>
    </div>





  </body>
</html>
