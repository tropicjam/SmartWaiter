<?php

	function revsubmit(){	
		
		$sesid = $_SESSION["username"];
		$servername = "db.tropicjam.co.uk";
		$username = "jamie";
		$password = "8GYEKSpJMvwyc3rt";
		$dbname = "jamie";
		$sessid = $sesid;
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if(empty($_POST["overall"])){
				$overallErr = "Please input an overall rating";
			}
			else{
				$overall = trim($_POST["overall"]);
			}
			if(empty($_POST["emotion"])){
				$emotionErr = "Field Required";
			}
			else{
				$emotion = trim($_POST["emotion"]);
			}
			$comment = ($_POST["comment"]);
			$sql1 = "INSERT INTO reviews (rating, emotion, comments) VALUES ('$overall', '$emotion', '$comment')";
			if ($conn->query($sql1) === TRUE) {
				header("location: home.php");
			} else {
				
			}
					
			$conn->close();	
			}
		}
	?>