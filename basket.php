<!DOCTYPE html> 
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/styles.css">
<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>
<style>
footer{
	position:absolute;
	bottom:0;
	width:100%;
}
.table-striped{
	font-size: 2em;
	margin: 0 auto;
	border-right: 1px solid black;
	border-left: 1px solid black;
	width:80%;
	background-color: #0043af;
	color:white;
}
.headerBsk{
	text-align: center;
}
.table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th {
   background-color: #0043af;
   color: white;
}
.delete {
	font-size:1.5em;
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
body {
    margin-top:10%;
}
.total{
	font-size:2em;
}
#btnOrder{
	border: none;
	background-color: #0043af;
	color: white;
	padding-top: 4%;
	padding-bottom: 4%;
	margin: 0 auto;
	font-size:1.25em;
}

.delete{
	border:none;
	background-color:#0043af;
	color:white;
	border-radius:3%;
	margin:none;
	padding:none;
}
tr{
	border: white 5px solid;
}
.delbtn{
	border-top:none;
	border-bottom: none;
	border:none;
	background-color: #0043af;
	color: white;
	border-radius:none;
}
.delbtn:hover{
	cursor:pointer;
}
.basket a{
	font-weight:bold;
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
		function deleteBsk($bskid){
		$servername = "db.tropicjam.co.uk";
		$username = "jamie";
		$password = "8GYEKSpJMvwyc3rt";
		$dbname = "jamie";
		$id = $bskid;
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$sql3= "DELETE FROM Basket WHERE basket_id= '$item';";
		$conn->query($sql3);
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
		$query = "SELECT * FROM Basket WHERE userid = $id"; 
		$result = $conn->query($query);
		echo "<div id = 'baskethead'><h2 class = 'headerBsk'>Your Table Number is " . $_SESSION['table'] . "</h4></div></br>";
		echo "<table class = 'table-striped'>"; 
		if ($result->num_rows > 0){;
		echo "<div class = 'headerBsk'><h3>Your Basket</h3></div></br></br>";
		while($row=$result->fetch_assoc()){   
		$bskid = $row['basket_id'];
		echo "<tr><td>" . $row["item_name"] . "</td><td class = 'tcost'>" . $row["price"] . "</td><td><form method ='post' action =''><input class = 'delbtn' type='submit' name= 'action' value= 'Delete'/><input type='hidden' name ='id' value ='$bskid'/></form></td></tr>";
		}
		echo "</table>"; 
		$query2 = "SELECT sum(price) FROM Basket WHERE userid = '$id';"; 
		$result2 = $conn->query($query2);
		while($row=$result2->fetch_assoc()){   
		echo "</br><h5 class = 'total'>Total: " .$row["sum(price)"]. "</h5></br>";
		}
		}
		if ($result->num_rows < 1){
			echo "<h2 id = 'noitems'>There's Nothing in Your Basket!</h2>";
		} 
		mysqli_close(); 
		
		if (isset($_POST['btnOrder'])){
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
		$maxtime = 0;
		$table = $_SESSION['table'];
		$sql1 = "SELECT item_name, f_or_d, customise FROM Basket WHERE userid = '$id'";
		$result = mysqli_query($conn,$sql1);
		if (mysqli_num_rows($result) <= 0) {
			$conn->close();
		}
		if (mysqli_num_rows($result) > 0) {

			while($row = mysqli_fetch_assoc($result)) {
				$row1 = $row["item_name"];
				$sql3 = "SELECT esttime FROM Item WHERE item_name = '$row1';";
				$result3 = mysqli_query($conn,$sql3);
				if (mysqli_num_rows($result3) > 0) {
					while($times = mysqli_fetch_assoc($result3)) {
						$time = $times['esttime'];
						if ($time > $maxtime){
							$maxtime = $time;
					}
				}
				}
				$row2 = $row["f_or_d"];
				$row3 = $row["customise"];

				$sql = "INSERT INTO orders (tableno, item_name, f_or_d, customise)
				VALUES ($table, '$row1', '$row2', '$row3');";
				if (mysqli_multi_query($conn, $sql)) {
					
				} 
				else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			}
			$sql2 = "DELETE FROM Basket WHERE userid = $id;";
			$conn->query($sql2);
			$conn->close();
			$url = "successorder.php?esttime=" . $maxtime;
			header("Location: $url");
		} 	
		else {
			
		}
	}
	if ($_POST['action'] && $_POST['id']) {
		if ($_POST['action'] == 'Delete') {
		// edit the post with $_POST['id']
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
			$var1 = $_POST['id'];
			$sql = "DELETE FROM Basket WHERE basket_id = '$var1';";
			$conn->query($sql);
			$conn->close();
			header("Location: basket.php");
	}
}
		?>
	<div class = "wrapper">
		<form  id = "orderForm" method = "post" ><input type = "submit" name= "btnOrder" id= "btnOrder" value= "Place Order"/></form>
	</div>
	<div class= "filler">
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