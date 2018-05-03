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
input[type="radio"]{
}
fieldset{
	margin-left: 2%;
	margin-right: 2%;
}
h5{
	text-align: center;
}
body{
	text-align:center;
}
#revSubmit{
	border:none;
	background-color: #0043af;
	color: white;
	padding-top:3%;
	padding-bottom:3%;
	padding-right:8%;
	padding-left:8%;
	border-radius:7%;
	margin-bottom: 3%;
}
#revSubmit:hover{
	border:none;
	background-color: #0043af;
	color: black;
	padding-top:3%;
	padding-bottom:3%;
	padding-right:8%;
	padding-left:8%;
	border-radius:7%;
	margin-bottom: 3%;
	cursor:pointer;
}
.error{
	color:red;
}
footer{
	width:100%;
}
#reviewfeedback{
	font-size:1.25em;
	color: #0043af;
	margin-top: 5%;
}
#radiocontainer{
	width: 27%;
	margin: auto;
	text-align:left;
}

</style>
</head>
<body>
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
	if(!isset($_POST['revSubmit'])){
		require 'reviewsubmit.php';
		revsubmit();
	}
	?>
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
		<form method ="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<fieldset>
				</br>
				<h2>Please provide us with your honest opinion of your experience whilst dining with us.</h2></br>
				<label>Please rate your overall experience*</label></br>
				<div id= "radiocontainer">
					<input class="radio" type="radio" name="overall" value="1"> 1 (Very Unsatisfactory)</br></br>
					<input class="radio" type="radio" name="overall" value="2"> 2 (Unsatisfactory)</br></br>
					<input class="radio" type="radio" name="overall" value="3"> 3 (No Opinion)</br></br>
					<input class="radio" type="radio" name="overall" value="4"> 4 (Satisfactory)</br></br>
					<input class="radio" type="radio" name="overall" value="5"> 5 (Very Satisfactory)</br></br>
				</div>
				<span class= "error"><?php echo $overallErr;?></span>
				<div class= "form-group">
					<label for= "emotion">In one word how did the table application make you feel when navigating through it*</label>
					<textarea name = "emotion" class ="form-control" rows="1" id = "emotion"></textarea>
					<span class = "error"><?php echo $emotionErr;?></span>
				</div>
				</br>
				<div class= "form-group">
					<label for="comment">Please leave any other comments:</label>
					<textarea name = "comment"class ="form-control" rows="6" id= "comment"></textarea>
				</div>
				<input type= "submit" name = "submit" id ="revSubmit" name ="revSubmit">
			</fieldset>
		</form>
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