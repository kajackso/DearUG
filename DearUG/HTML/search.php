<!DOCTYPE html>
<html>
<link rel="stylesheet" href="format.css">
  <body>
    <h1>Search</h1>
    <h2>
    <a href="Main.html">Home</a>
    <a href="new.php">New</a>
    <form method=post action="search.php">
      <input type="text" id="fname" name="fname" placeholder="Search">
      <input type="submit" value="Submit">
    </form>
    <a href="action.php" >Login</a>
    <a href="register.php">Register</a>
    </h2>

<?php

        $dbhost = 'mysql:host=classdb.it.mtu.edu;port=3307;dbname=fisforsuccess';
        $dbuser = 'fisforsuccess_rw';
        $dbpass = 'success123';
		
        try {
			$dbconnect = new PDO($dbhost, $dbuser, $dbpass);	
			if(isset($_POST['fname'])) {
				$search = "\"" . $_POST['fname'] . "\"";
				foreach($dbconnect->query("call search($search)") as $row){
					$username = $row[0];
					$description = $row[1];
					$postName = $row[2];
					echo "</br>" . "Username: " . $username . "</br>Description: " . $description . "</br>PostName: " . $postName . "</br>";
					
				}
			} else {
				echo 'No Results: var not given';
			}
		}
			
		catch (PDOException $error) {
            die("ERROR: " . $error->getMessage() . "<br/>");
			
        }



?>

</body>
</html>
