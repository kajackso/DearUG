<!DOCTYPE html>
<html>
<link rel="stylesheet" href="format.css">
<meta charset="UTF-8">
<title>Register</title>
  <body>
  <?php
        $dbhost = 'mysql:host=classdb.it.mtu.edu;port=3307;dbname=fisforsuccess';
        $dbuser = 'fisforsuccess_rw';
        $dbpass = 'success123';
        try {
            // Attempt to connect to database. Check if username, email, password, major, and graddate are all populated.
            $dbconnect = new PDO($dbhost, $dbuser, $dbpass);
            if(isset($_POST["userName"])) {
                if(isset($_POST["email"])){
                    if(isset($_POST["pass"])){
                        if(isset($_POST["Major"])){
                            if(isset($_POST["GradDate"])){
                              echo $_POST['userName'];
                              // All of the information is populated correctly. We can create a new user using the newUser procedure. Uses a prepared statement to avoid SQL injection.
                              $statement = $dbconnect -> prepare("CALL newUser(:userName, :email, :pass, :Major, :GradDate)");
                              $result = $statement -> execute(array(':userName'=> $_POST['userName'], ':email'=>$_POST['email'], ':pass'=>$_POST['pass'], ':Major'=>$_POST['Major'], ':GradDate'=>$_POST['GradDate']));
                              // Take the user to the login page.
                              header("Location: https://classdb.it.mtu.edu/cs3141/FisForSuccess/logintest.html");
                            }
                        }
                    }
                }
            }
        }

        catch (PDOException $error) {
            die("ERROR: " . $error . "<br/>");
        }
    ?>


  <!-- HTML code -->
  <h1>Register</h1>
  <h2>
    <a href="Main.html">Home</a>
    <a href="createPost.html">New</a>
    <a href="Tags.html">Tags</a>
    <form action="search.php">
      <input type="text" id="fname" name="fname" placeholder="Search">
      <input type="submit" value="Submit">
    </form>
    <a href="action.php">Login</a>
    <a href="register.php">Register</a>
  </h2>

  <form method=post action=register.php>
    <label for="userName">Username:</label>
    <input type="text" id="userName" name="userName"><br><br>
    <label for="Email">Email:</label>
    <input type="text" id="email" name="email"><br><br>
    <label for="GradDate">Graduation Date:</label>
    <input type="text" id="GradDate" name="GradDate"><br><br>
    <label for="Major">Major:</label>
    <input type="text" id="Major" name="Major"><br><br>
    <label for="pass">Password:</label>
    <input type="password" id="pass" name="pass"><br><br>
    <input type="submit" value="Submit">

  </form>
  </body>
</html>
