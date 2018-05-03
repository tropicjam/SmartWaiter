<!DOCTYPE html> 
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/styles.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

function reload() {
    location.reload(true);
}
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
body{
	padding-top:15%;
}
main{
	margin-top:none;
}
.row{
	padding-top: 2%;
	padding-bottom: 2%;
	margin-left: 6%;
	margin-right: 6%;
	margin-top: 5%;
	margin-bottom: 5%;
}
.dbtn{
	font-weight: bold;
	border: 2px white solid;
	margin-left:70%;
	margin-bottom: 8%;
	margin-top:none;
	display: inline-block;
	color: white;
	background-color: #0043af;
	font-weight:bold;
	border-radius:10%;
	padding-top: 20%;
	padding-bottom: 20%;
	padding-left: 10%;
	padding-right: 10%;
	width:200%;
}
.dbtn:hover{
	text-decoration; none;
	color: black;
	border: black 2px solid;
	cursor:pointer;
}
.drinkshead{
	background-color: black;
	color: white;
	margin: 0 auto;
	width:50%;
	padding:2%;
}
.count{
	display:inline-block;
	color:white;
}
.basket{
	margin-top:15%;
}
.navbar{
	position:absolute;
}
.added{
	font-size: 1.25em;
	color: #0043af;
	margin-top: 5%;
}
#drinkdis{
	margin-top:2%;
}

</style>
</head>
<body>
	<div id="mySidenav" class="sidenav">
	  <a class = "logoutbtn" href="logout.php">Logout</a>
	  <a href="home.php">Home</a>
	  <a href= "MainMenu.php">Main Menu</a>
	  <a href= "Drinksmenu.php">Drinks Menu</a>
	  <a href= "Dessert.php">Dessert Menu</a> 
	  <a href="review.php">Review</a>
	</div>
	<header>
		<nav class="navbar navbar-default">
		  <div class="container-fluid">
		  	<ul class="nav navbar-nav">
			  <li><span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span></li>
			</ul>
			<div class="navbar-header">
			  <a class="navbar-brand" href="home.php"><img class = "logo" src= "images/white_logo.png" alt = "Smart Waiter"></a>
			</div>
			<ul class="nav navbar-nav">
			  <li><div class= "basket"><a href= "basket.php">Basket (<?php countBsk();?>)</a></div></li>
			</ul>
		  </div>
		</nav>
	</header>
	<?php

	session_start();
	if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
	header("location: login.php");
	exit;
	}
	function countBsk(){
	session_start();

	// If session variable is not set it will redirect to login page
	if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
	  header("location: login.php");
	  exit;
	}
	$servername = "db.tropicjam.co.uk";
	$username = "jamie";
	$password = "8GYEKSpJMvwyc3rt";
	$dbname = "jamie";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}	
	$sessid = $_SESSION['username'];
	$idselect = "SELECT id from users where username='$sessid'";

	$idresult = mysqli_query($conn,$idselect);
	$results = mysqli_fetch_array($idresult);
	$id = $results['id'];
	$sql = "SELECT COUNT(*) count FROM Basket WHERE userid = '$id';";
	$result = $conn->query($sql);
	while($row=$result->fetch_assoc()){
		echo "<p class = 'count'>" .$row['count']. "</p>";
	}
}
	$sesid = $_SESSION["username"];
	
	if (isset($_POST['adddrink1'])){
	$item = 7;
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
	
	$idselect = "SELECT id from users where username='$sessid'";

	$idresult = mysqli_query($conn,$idselect);
	$results = mysqli_fetch_array($idresult);
	$id = $results['id'];
	echo $id, $item;
	
	$sql1 = "SELECT item_name, Price, f_or_d FROM Item WHERE item_no = $item";
	$result = $conn->query($sql1);	
	if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$price = $row["Price"];
			$name = $row["item_name"];
			$f_or_d = $row["f_or_d"];
		}
	}
	else {
		echo "0 Results";
	}
	$sql2 = "INSERT INTO Basket (item_name, price, userid, f_or_d)
	VALUES ('$name', '$price', '$id', '$f_or_d')";
	if ($conn->query($sql2) === TRUE) {
		echo "<p class = 'added'>Added to Basket</p>";
	} else {
		echo "Error: " . $sql2 . "<br>" . $conn->error;
	}
	countBsk();
	header("Location: Drinksmenu.php");
	$conn->close();

}
if (isset($_POST['adddrink2'])){
	$item = 8;
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
	
	$idselect = "SELECT id from users where username='$sessid'";

	$idresult = mysqli_query($conn,$idselect);
	$results = mysqli_fetch_array($idresult);
	$id = $results['id'];
	echo $id, $item;
	
	$sql1 = "SELECT item_name, Price, f_or_d FROM Item WHERE item_no = $item";
	$result = $conn->query($sql1);	
	if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$price = $row["Price"];
			$name = $row["item_name"];
			$f_or_d = $row["f_or_d"];
		}
	}
	else {
		echo "0 Results";
	}
	$sql2 = "INSERT INTO Basket (item_name, price, userid, f_or_d)
	VALUES ('$name', '$price', '$id', '$f_or_d')";
	if ($conn->query($sql2) === TRUE) {
		echo "<p class = 'added'>Added to Basket</p>";
	} else {
		echo "Error: " . $sql2 . "<br>" . $conn->error;
	}
	countBsk();
	header("Location: Drinksmenu.php");		
	$conn->close();
}
if (isset($_POST['adddrink3'])){
	$item = 9;
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
	
	$idselect = "SELECT id from users where username='$sessid'";

	$idresult = mysqli_query($conn,$idselect);
	$results = mysqli_fetch_array($idresult);
	$id = $results['id'];
	echo $id, $item;
	
	$sql1 = "SELECT item_name, Price, f_or_d FROM Item WHERE item_no = $item";
	$result = $conn->query($sql1);	
	if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$price = $row["Price"];
			$name = $row["item_name"];
			$f_or_d = $row["f_or_d"];
		}
	}
	else {
		echo "0 Results";
	}
	$sql2 = "INSERT INTO Basket (item_name, price, userid, f_or_d)
	VALUES ('$name', '$price', '$id', '$f_or_d')";
	if ($conn->query($sql2) === TRUE) {
		echo "<p class = 'added'>Added to Basket</p>";
	} else {
		echo "Error: " . $sql2 . "<br>" . $conn->error;
	}
	countBsk();
	header("Location: Drinksmenu.php");
	$conn->close();
}
if (isset($_POST['adddrink4'])){
	$item = 10;
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
	
	$idselect = "SELECT id from users where username='$sessid'";

	$idresult = mysqli_query($conn,$idselect);
	$results = mysqli_fetch_array($idresult);
	$id = $results['id'];
	echo $id, $item;
	
	$sql1 = "SELECT item_name, Price, f_or_d FROM Item WHERE item_no = $item";
	$result = $conn->query($sql1);	
	if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$price = $row["Price"];
			$name = $row["item_name"];
			$f_or_d = $row["f_or_d"];
		}
	}
	else {
		echo "0 Results";
	}
	$sql2 = "INSERT INTO Basket (item_name, price, userid, f_or_d)
	VALUES ('$name', '$price', '$id', '$f_or_d')";
	if ($conn->query($sql2) === TRUE) {
		echo "<p class = 'added'>Added to Basket</p>";
	} else {
		echo "Error: " . $sql2 . "<br>" . $conn->error;
	}
	countBsk();
	header("Location: Drinksmenu.php");
	$conn->close();
}
if (isset($_POST['adddrink5'])){
	$item = 11;
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
	
	$idselect = "SELECT id from users where username='$sessid'";

	$idresult = mysqli_query($conn,$idselect);
	$results = mysqli_fetch_array($idresult);
	$id = $results['id'];
	echo $id, $item;
	
	$sql1 = "SELECT item_name, Price, f_or_d FROM Item WHERE item_no = $item";
	$result = $conn->query($sql1);	
	if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$price = $row["Price"];
			$name = $row["item_name"];
			$f_or_d = $row["f_or_d"];
		}
	}
	else {
		echo "0 Results";
	}
	$sql2 = "INSERT INTO Basket (item_name, price, userid, f_or_d)
	VALUES ('$name', '$price', '$id', '$f_or_d')";
	if ($conn->query($sql2) === TRUE) {
		echo "<p class = 'added'>Added to Basket</p>";
	} else {
		echo "Error: " . $sql2 . "<br>" . $conn->error;
	}
	countBsk();
	header("Location: Drinksmenu.php");	
	$conn->close();
}
if (isset($_POST['adddrink6'])){
	$item = 12;
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
	
	$idselect = "SELECT id from users where username='$sessid'";

	$idresult = mysqli_query($conn,$idselect);
	$results = mysqli_fetch_array($idresult);
	$id = $results['id'];
	echo $id, $item;
	
	$sql1 = "SELECT item_name, Price, f_or_d FROM Item WHERE item_no = $item";
	$result = $conn->query($sql1);	
	if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$price = $row["Price"];
			$name = $row["item_name"];
			$f_or_d = $row["f_or_d"];
		}
	}
	else {
		echo "0 Results";
	}
	$sql2 = "INSERT INTO Basket (item_name, price, userid, f_or_d)
	VALUES ('$name', '$price', '$id', '$f_or_d')";
	if ($conn->query($sql2) === TRUE) {
		echo "<p class = 'added'>Added to Basket</p>";
	} else {
		echo "Error: " . $sql2 . "<br>" . $conn->error;
	}
	countBsk();
	header("Location: Drinksmenu.php");	
	$conn->close();
}
?>
	<main onclick="closeNav()">
	<div class = "drinkshead">
		<h4>Alcoholic Beverages</h4>
	</div>
	<p id="drinkdis">Please note any person's under 25 will require photographic identification for any alcohlic beverages</p>
	<div class= "row">
				<h3 class= "col-sm-7" id = "drinkitem1" class = "menuitem">Stella Artois</h3>
				<h3 id = "drinkprice1" class = "menuitem">£3.00</h3>
				<form method="post"><button class="dbtn" type="submit" name ="adddrink1">ADD</button></form>	
	</div>
	<div class= "row">
				<h3 class= "col-sm-7" id = "drinkitem2" class = "menuitem">Strongbow</h3>
				<h3 id = "drinkprice2" class = "menuitem">£2.80</h3>
				<form method="post"><button class="dbtn" type="submit" name ="adddrink2">ADD</button></form>	
	</div>
	<div class= "row">
				<h3 class= "col-sm-7" id = "drinkitem3" class = "menuitem">San Miguel</h3>
				<h3 id = "drinkprice3" class = "menuitem">£3.50</h3>
				<form method="post"><button class="dbtn" type="submit" name ="adddrink3">ADD</button></form>	
	</div>
	<div class = "drinkshead">
		<h4>Soft Drinks</h4>
	</div>
		<div class= "row">
				<h3 class= "col-sm-7" id = "drinkitem4" class = "menuitem">Pepsi</h3>
				<h3 id = "drinkprice4" class = "menuitem">£2.50</h3>
				<form method="post"><button class="dbtn" type="submit" name ="adddrink4">ADD</button></form>	
		</div>
		<div class= "row">
				<h3 class= "col-sm-7" id = "drinkitem5" class = "menuitem">Lemonade</h3>
				<h3 id = "drinkprice5" class = "menuitem">£2.20</h3>
				<form method="post"><button class="dbtn" type="submit" name ="adddrink5">ADD</button></form>	
		</div>
		<div class= "row">
				<h3 class= "col-sm-7" id = "drinkitem6" class = "menuitem">Orange Juice</h3>
				<h3 id = "drinkprice6" class = "menuitem">£2.00</h3>
				<form method="post"><button class="dbtn" type="submit" name ="adddrink6">ADD</button></form>	
		</div>
	</main>
	<?php
	if (isset($_POST['alert'])){
		session_start();
		// If session variable is not set it will redirect to login page
		if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
		  header("location: login.php");
		  exit;
		}
		$table = $_SESSION['table'];
		$servername = "db.tropicjam.co.uk";
		$username = "jamie";
		$password = "8GYEKSpJMvwyc3rt";
		$dbname = "jamie";
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}	
		$sql = "INSERT INTO alert (tableno) VALUES ($table);";
		if (mysqli_multi_query($conn, $sql)) {
					echo '<script language="javascript">';
					echo 'alert("A Staff Member is on their way!")';
					echo '</script>';
				} 
				else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
	}
	?>
	<footer>
		<div class= "footer">
			<form method="post"><button name ="alert" class="assist" onclick="assistalert">Press for Assistance</button>
		</div>
	</footer>
</body>
</html>