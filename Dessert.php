<!DOCTYPE html> 
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/styles.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
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
.btn{
	font-weight: bold;
	border: 2px white solid;
	margin-left:5%;
	margin-bottom:2%;
	width:15%;
	
}
.btn:hover{
	text-decoration; none;
	color: black;
	border: black 2px solid;
}
.row{
	padding-top: 2%;
	padding-botton: 3%;
	margin-left: 6%;
	margin-right: 6%;
	margin-top: 5%;
	margin-bottom: 5%;
}
.myModalLabel{
	text-align:center;
	color: #0043af;
}
.submit{
	margin: 0 auto;
	border: none;
	background-color: #0043af;
	color:white;
	padding: 2%;
	padding-left: 5%;
	padding-right: 5%;
}
.footer{
	position: absolute;
	bottom: 0;
	width: 100%;
}
.added{
	font-size: 1.25em;
	color: #0043af;
	margin-top: 5%;
}
.modal-backdrop.in {
	opacity: 0.5;
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
		$sesid = $_SESSION["username"];
			if (isset($_POST['additem1'])){
			$item = 15;
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
				$customise = ($_POST["customise"]);

				$sql2 = "INSERT INTO Basket (item_name, price, userid, f_or_d, customise)
				VALUES ('$name', '$price', '$id', '$f_or_d', '$customise')";
				if ($conn->query($sql2) === TRUE) {
					
				} else {
					echo "Error: " . $sql2 . "<br>" . $conn->error;
				}
				countBsk();
				header("Location: Dessert.php");
				$conn->close();
		}
		if (isset($_POST['additem2'])){
			$item = 16;
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
				$customise = ($_POST["customise"]);

				$sql2 = "INSERT INTO Basket (item_name, price, userid, f_or_d, customise)
				VALUES ('$name', '$price', '$id', '$f_or_d', '$customise')";
				if ($conn->query($sql2) === TRUE) {
					
				} else {
					echo "Error: " . $sql2 . "<br>" . $conn->error;
				}	
				countBsk();
				header("Location: Dessert.php");
				$conn->close();
		}
		if (isset($_POST['additem3'])){
			$item = 17;
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
				$customise = ($_POST["customise"]);

				$sql2 = "INSERT INTO Basket (item_name, price, userid, f_or_d, customise)
				VALUES ('$name', '$price', '$id', '$f_or_d', '$customise')";
				if ($conn->query($sql2) === TRUE) {
					
				} else {
					echo "Error: " . $sql2 . "<br>" . $conn->error;
				}
				countBsk();
				header("Location: Dessert.php");
				$conn->close();
		}
		?>
		<div id="myModal1" class="modal" tabindex="-1" role="dialog">
			<div class = "modal-dialog" role= "document">
				<div class = "modal-content">
					<div class="modal-header">
						<h3 class="myModalLabel">Customise Your Meal</h3>
					</div>
					<div class="modal-body">
						<h5>Please enter any additional information our kitchen to complete your meal</h5>
						</br>
						<form class = "modalform" method="post">
						<fieldset>
							<textarea rows= "6" cols="40" name = "customise"></textarea>
							</br></br>
							<button class = "submit" id = "submit" type="submit" name  = "additem1">Add to Basket</button>
						</fieldset>
						</form>
					</div>
					<div class="modal-footer">
						<button class="submit" data-dismiss="modal" aria-hidden="true">Close</button>
					</div>
				</div>
			</div>
		</div>
		<div id="myModal2" class="modal" tabindex="-1" role="dialog">
			<div class = "modal-dialog" role= "document">
				<div class = "modal-content">
					<div class="modal-header">
						<h3 class="myModalLabel">Customise Your Dessert</h3>
					</div>
					<div class="modal-body">
						<h5>Please specify whether you would like cream, ice cream, or custard</h5>
						</br>
						<form method="post">
						<fieldset>
							<textarea class= "form-group" rows= "6" cols="40" name = "customise"></textarea>
							</br></br>
							<button class = "submit" id = "submit" type="submit" name  = "additem2">Add to Basket</button>
						</fieldset>
						</form>
					</div>
					<div class="modal-footer">
						<button class="submit" data-dismiss="modal" aria-hidden="true">Close</button>
					</div>
				</div>
			</div>
		</div>
		<div id="myModal3" class="modal" tabindex="-1" role="dialog">
			<div class = "modal-dialog" role= "document">
				<div class = "modal-content">
					<div class="modal-header">
						<h3 class="myModalLabel">Customise Your Dessert</h3>
					</div>
					<div class="modal-body">
						<h5>Please specify whether you would like cream, ice cream, or custard</h5>
						</br>
						<form method="post">
						<fieldset>
							<textarea class= "form-group" rows= "6" cols="40" name = "customise"></textarea>
							</br></br>
							<button  class = "submit" id = "submit" type="submit" name  = "additem3">Add to Basket</button>
						</fieldset>
						</form>
					</div>
					<div class="modal-footer">
						<button class="submit" data-dismiss="modal" aria-hidden="true">Close</button>
					</div>
				</div>
			</div>
		</div>
		<div class= "row" >
				<h3 class= "col-sm-7" class = "menuitem">New York Cheesecake</h3>
				<h3 class = "menuitem">£5.80</h3>
				<a href="#myModal1" role="button" class="btn" data-toggle="modal">ADD</a>	
		</div>
		<div class= "row">
				<h3 class= "col-sm-7" class = "menuitem">Hot Chocolate Fudge Cake</h3>
				<h3 class = "menuitem">£5.40</h3>
				<a href="#myModal2" role="button" class="btn" data-toggle="modal">ADD</a>	
		</div>
		<div class= "row">
				<h3 class= "col-sm-7" class = "menuitem">Apple Pie</h3>
				<h3  class = "menuitem">£5.50</h3>
				<a href="#myModal3" role="button" class="btn" data-toggle="modal">ADD</a>	
		</div>
	</main
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