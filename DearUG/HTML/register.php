<!DOCTYPE html>
<html>
<link rel="stylesheet" href="format.css">
  <body>
  <?php
        $dbhost = 'mysql:host=classdb.it.mtu.edu;port=3307;dbname=fisforsuccess';
        $dbuser = 'fisforsuccess_rw';
        $dbpass = 'success123';
        try {
            $dbconnect = new PDO($dbhost, $dbuser, $dbpass);
            if(isset($_POST["userName"])) {
                if(isset($_POST["email"])){
                    if(isset($_POST["pass"])){
                        if(isset($_POST["Major"])){
                            if(isset($_POST["GradDate"])){
                              echo $_POST['userName'];
                              $statement = $dbconnect -> prepare("CALL newUser(:userName, :email, :pass, :Major, :GradDate)");
                              $result = $statement -> execute(array(':userName'=> $_POST['userName'], ':email'=>$_POST['email'], ':pass'=>$_POST['pass'], ':Major'=>$_POST['Major'], ':GradDate'=>$_POST['GradDate']));
                              header("Location: https://classdb.it.mtu.edu/cs3141/FisForSuccess/Login.html");
                            }
                        }
                    }
                }
            } else {

            }
        }

        catch (PDOException $error) {
            die("ERROR: " . $error . "<br/>");
        }
    ?>
  <h1>Login</h1>
  <h2>
    <a href="Main.html">Home</a>
    <a href="Tags.html">Tags</a>
    <form action="Search.html">
      <input type="text" id="fname" name="fname">
      <input type="submit" value="Submit">
    </form>
    <a href="Login.html">Login</a>
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
