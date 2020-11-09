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
                if(isset($_POST["E-mail"])){
                    if(isset($_POST["pass"])){
                        if(isset($_POST["Major"])){
                            if(isset($_POST["GradDate"])){
                              $userName = $_POST["userName"];
                              $eMail = $_POST["E-mail"];
                              $pass = $_POST["pass"];
                              $Major = $_POST["Major"];
                              $GradDate = $_POST["GradDate"];

                            }
                        }
                    }
                }
            } else {
              echo "missing field";
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

  <form action="/createAccount.php">
    <label for="userName">Username:</label>
    <input type="text" id="userName" name="userName"><br><br>
    <label for="E-mail">Email:</label>
    <input type="text" id="e-mail" name="e-mail"><br><br>
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
