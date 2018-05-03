<!DOCTYPE html> 
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/styles.css?v=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}
function openColourNav(){
	document.getElementById("myColournav").style.width = "250px";
}
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
function closeColourNav(){
	document.getElementById("myColournav").style.width = "0";
}
function assistalert() {
    alert("A Staff Member is on their way!");
}
</script>
<style>

.navbar{
	background-color: #0043af;
	color: white;
	overflow: hidden;
	position: fixed;
	top: 0;
	width: 100%;
}
#homeimage{
	width:100%;
	height:auto%;
}
.count{
	display:inline-block;
	color:white;
}
.basket{
	margin-top:15%;
}
html {
    position: relative;
    min-height: 100%;
}
#aboutbtn{
	width:300px;
	background-color:transparent;
}
#mainbtn{
	
}
#drinksbtn{
	
}
#dessertbtn{
	
}
.image{
	max-width:100%;
	max-height:100%;
}
div.polaroid {
  width: 45%;
  background-color: #0043af;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  margin: 0 auto;
  margin-top: 10%;
  margin-bottom: 10%;
}
div.container {
  text-align: center;
  padding: 10px 20px;
  color: white;
  margin: none;
}
.homerow{
	background: white;
	margin: 0 ;
}
.assist{
	border: none;
	background-color: white;
	color: #0043af;
	margin: 0 auto;
	font-size:2em;
}
.footer{
	background-color:#0043af;
	height:100px;
	padding:none;
	margin:none;
	color:white;
	align-items: center;
	justify-content: center;
	display: flex;
}
.logo{
	height:60px;
	width: 200px;
	margin-left:15%;
}
.logoutbtn{
	margin-top:10%;
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
		<nav class="navbar navbar-default sticky-top">
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
	<main onclick="closeNav()">
		<img id = "homeimage" src = "images/burger_and_chips.jpeg" alt = "Burger and Chips">
			<div class= "row" style="background-color:white; margin:none;">
				<div class = "polaroid" class= "col-sm-6">
					<a href= "About.php">
						<img class = "image" src = "images/about.png" alt = "About Us">
						<div class= "container">
							<h3>About Us</h3>
						</div>
					</a>
				</div>
				<div class = "polaroid" class= "col-sm-6">
					<a href= "MainMenu.php">
						<img class = "image" src = "images/menu.png" alt = "Main Menu">
						<div class= "container">
							<h3>Main Menu</h3>
						</div>
					</a>
				</div>
			</div>
			<div class= "row" style="background-color:white; margin:none;">
				<div class = "polaroid" class= "col-sm-6">
					<a href= "Drinksmenu.php">
						<img class = "image" src = "images/drinks.png" alt = "Drinks Menu">
						<div class= "container">
							<h3>Drinks Menu</h3>
						</div>
					</a>
				</div>
				<div class = "polaroid" class= "col-sm-6">
					<a href= "Dessert.php">
						<img class = "image" src = "images/dessert.png" alt = "Dessert Menu">
						<div class= "container">
							<h3>Dessert Menu</h3>
						</div>
					</a>
				</div>
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
	<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
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
?>
</body>
</html>
