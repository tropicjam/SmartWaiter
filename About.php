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
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
.aboutwrap{
	margin-left:10%;
	margin-right:10%;
	color: white;
	background-color: #0043af;
	font-size:1.1em;	
}
.aboutwrap p{
	padding-top:1%;
	padding-bottom:1%;
}
#aboutHead{
	background-color: #0043af;
	color: white;
	padding-top:1%;
	padding-bottom:1%;
}
footer{
	position:absolute;
	bottom:0;
	width:100%;
}
#wrap{
	background-color: #0043af;
	margin-bottom: 5%;
}
body{
	margin-top:5%;
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
		<h2 id= "aboutHead">About Our Application</h2></br></br>
		<div id ="wrap">
			<div class="aboutwrap">
				<p>
					<b>The Smart Waiter application is a fast and efficient way for you to enjoy your restuarant experience.</b></br></br> 
					To get started please take time to navigate through the application to get comfortable with the layout of our menus.</br>
					Once you have got yourself comfortable with the application please select the menu you wish to order from</br>
					You will then be able to select the items off of our menu, once selected a personalisation screen will appear, in this screen you will be able to input any dietary requirements that you require</br>
					Then by selecting the add button, your choice will be added to your basket.</br>
					Once you are happy with your basket please press the 'Place Order' button and then your order will be sent to our staff who will prepare you order as fast as possible.</br>
					If you require any assistance at all please select the 'Press for Assistance' button located at the bottom of our pages.</br>
					Thank you for choosing Smart Waiter please enjoy you restaurant experience and leave us a review once you are finished.
				</p>
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
	?>
</body>
</html>