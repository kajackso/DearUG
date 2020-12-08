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
    <a href="destroy.php" >Logout</a>
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
				foreach($dbconnect->query("select u.username from user u
										   where u.username like concat('%', $search, '%');") as $row){
					$username = $row[0];
					echo "Username: " . $username . "</br>";

				} echo "</br>";

				foreach($dbconnect->query("select p.name, p.description from post p
										   where p.description like concat('%', $search, '%');") as $row){
					$postName = $row[0];
					$description = $row[1];
					echo "Post Name: " . $postName . "</br>" . "Post Description: " . $description . "</br></br>";

				} echo "</br>";

				foreach($dbconnect->query("select t.tagName from tags t
										   where t.tagName like concat('%', $search, '%');") as $row){
					$tagName = $row[0];
					echo "Tag: " . $TagName . "</br></br>";

				} echo "</br>";

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
