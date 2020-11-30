<!DOCTYPE html>
<html>
<link rel="stylesheet" href="format.css">
  <body>

    <h1>Search</h1>
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

<?php
session_start();

        $dbhost = 'mysql:host=classdb.it.mtu.edu;port=3307;dbname=fisforsuccess';
        $dbuser = 'fisforsuccess_rw';
        $dbpass = 'success123';
		
        try {
			$dbconnect = new PDO($dbhost, $dbuser, $dbpass);
			
			//Testing, delete later
			//var_dump($_POST);
			
			$search = $_SESSION['fname'];
			if(isset($_SESSION['fname'])){
				
				//Testing $search = General
				//echo $search;
				
				$sql = " select* from tags where tagName =" . $search ;
				//$result = $dbconnect->query($sql);
							
				$result = $dbconnect->query($sql);
				
				//$query = mysql_query(" CALL search('$search'); ");
				//$num_rows = mysql_num_rows($query);
				
				foreach($result as $row){
					$id = $row[0];
					$tagId = $row[1];
					$tagName = $row[2];
					echo "ID" . $id . "tagID" . $tagId . "tagName" . $tagName;
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
