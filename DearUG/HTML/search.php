<!DOCTYPE html>
<html>
<link rel="stylesheet" href="format.css">
  <body>

    <h1>Search</h1>
    <h2>
      <a href="Main.html">Home</a>
      <a href="createPost.html">New</a>
      <a href="Tags.html">Tags</a>
      <form method="post" action="search.php">
        <input type="text" id="fname" name="fname" placeholder="Search">
        <input type="submit" value="Submit">
      </form>
      <a href="Login.html">Login</a>
      <a href="register.php">Register</a>
    </h2>
   
<?php
        $dbhost = 'mysql:host=classdb.it.mtu.edu;port=3307;dbname=fisforsuccess';
        $dbuser = 'fisforsuccess_rw';
        $dbpass = 'success123';
		
        try {
			$dbconnect = new PDO($dbhost, $dbuser, $dbpass);
			$search = $_POST["search"];
			if(!isset($search)){
				echo 'fname not given';
			} else {
				//Testing, delete later 
				echo $search;
				
				//$statement = $dbconnect -> prepare("CALL search(:search)");
				//$result = $statement -> execute(array(':search'=> $_POST['search']));
				
				$sql = 'CALL search("$search")' ;
				$result = $dbconnect->query($sql);
				//$query = mysql_query('CALL search('$_POST["search"]')');
				//$row = mysql_num_rows($query);
			
				//while($result = mysql_fetch_array($statement)){
				while($row = $result->fetch(PDO::FETCH_ASSOC)){
					$id = $row["$search"];
				
					echo $id;
				}
			}
		}
			
		catch (PDOException $error) {
            die("ERROR: " . $error->getMessage() . "<br/>");
			
        }



?>

</body>   
</html>  
