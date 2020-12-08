<?php // Initialize the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="format.css">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>
<?php






//$dbhost = 'mysql:host=classdb.it.mtu.edu;port=3307;dbname=fisforsuccess';
$dbhost = 'classdb.it.mtu.edu';
$dbport = '3307';
$dbname = 'fisforsuccess';
$dbuser = 'fisforsuccess_rw';
$dbpass = 'success123';

$link = new mysqli($dbhost, $dbuser, $dbpass,$dbname,$dbport);


//$_SESSION["username"] = "defualt";

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: Main.html");
    exit;
}


// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $password = $_POST["password"];
    $username = $_POST["username"];


    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT username, password FROM user WHERE username = ?";
        //"select username from user where encrypt(?) = user.password andwhere $username = user.username";
        //if sql != null;


        if($stmt = mysqli_prepare($link, $sql)){
        //if($stmt = $link -> prepare("SELECT username, password FROM users WHERE username = ?")){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, 's', $param_username);
            // Set parameters
            $param_username = $username;
            //$_SESSION["username"] = $username;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password); //$id,


                    if(mysqli_stmt_fetch($stmt)){


                        //if(password_verify($password, $hashed_password)){
                        if(crypt($password,"UG") == $hashed_password) {
                            // Password is correct, so start a new session
                            //session_start();

                            //$_SESSION["id"] = $id;
                            $_SESSION["username"] = $_POST["username"];
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;


                            // Redirect user to main page
                            header("location: Main.html");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}

?>

    <div class="wrapper">
        <h1>Login</h1>

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

        <p>Please fill in your credentials to login.</p>

        <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>
            <div class="form-group" action=<?php echo (!empty($username_err)) ? 'has-error' : ''; ?>
                <label>Username</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>


            <div class=form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>
                <label>Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>


            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>

            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>

        </form>
    </div>


</body>
</html>
