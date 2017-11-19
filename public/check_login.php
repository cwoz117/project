<!DOCTYPE=html>
<html>
	<body>
	<?php
	
		$username = $password = "";
	
	if ($_SERVER["REQUEST_METHOD"]=="POST") {
		if (empty($_POST["username"])) {
			$username="";
		} else {
			$username = test_input($_POST["username"]);
		}
		
		if (empty($_POST["password"])) {
			$password="";
		} else {
			$password = test_input($_POST["password"]);
		}
	}
	
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
	
		echo $username;

		$servername = "localhost";
		$susername = "root";
		$password = "";
		$dbname = "truckco";	
	
		$conn = new mysqli($servername, $susername, $password, $dbname);		

		//if ($conn) {
		//	echo "Connected<br>";
		//else {
		//	echo "Not Connected<br>";
		//}		

		if($conn->connect_error) {
			echo "Connection failed<br>";	
			die("Connection failed: " . $conn->connect_error);
		} else {
			echo "Success<br>";
		}

			$sql = "SELECT DISTINCT password FROM Users WHERE username=john";
			
			$result = $conn->query($sql);
			if ($result->num_rows>0) {
				while($row=$result->fetch_assoc()) {
					echo "Password :". $row["password"]."<br>";
				}
			} else {
				echo "Not Found <br>";
			}
			$conn->close();
		?>
	
	</body> 

</html>
