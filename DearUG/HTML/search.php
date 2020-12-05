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
session_start();
        $dbhost = 'mysql:host=classdb.it.mtu.edu;port=3307;dbname=fisforsuccess';
        $dbuser = 'fisforsuccess_rw';
        $dbpass = 'success123';
		
        try {
			$dbconnect = new PDO($dbhost, $dbuser, $dbpass);
			
			//Testing, delete later
			//echo "Searched: " . $_POST['fname'];
			$searched = $_POST['fname'];
			$_SESSION['fname'] = $searched;
			$fname = $_SESSION['fname'];
			
			
			if(isset($_SESSION['fname'])){
				$sql = " call search('a'); " ;
				//$sql = " call search(':fname'); " ;
				$result = $dbconnect->query($sql);
				
				//$stmt = $dbconnect->prepare($sql);
				//$result = $stmt->execute(array(':fname'=>$_POST["fname"]));
				
				
				foreach($result as $row){
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
