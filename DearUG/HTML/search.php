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
			
			//Testing, delete later
			//var_dump($_POST);
			
			$search = $_POST["search"];
			if(isset($_POST['search'])){
				
				//Testing $search = General
				//echo $search;
				
				//$statement = $dbconnect -> prepare("CALL search(:search)");
				//$result = $statement -> execute(array(':search'=> $_POST['search']));
				
				$sql = ' select* from tags where tagName = "$search"; ';
				$result = $dbconnect->query($sql);
				
				//$query = mysql_query(" CALL search('$search'); ");
				//$num_rows = mysql_num_rows($query);
				foreach($result as $row){
					echo "results";
					//$id = $row['tag'];
					//echo $id;
					echo $row[0];
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
