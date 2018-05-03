<!DOCTYPE html> 
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<meta http-equiv="refresh" content="5">
<title>Bar Application</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/backend.css">
<style>
body{
	background-color:black;
}
h3{
	color:white;
	border: white 1px solid;
}
table{
	color: white;
	margin-left:0.5%;
}
td{
	color:white;
}
.sendorder{
	background-color: white;
	color: black;
	border:none;
	margin-bottom: 3%;
	display: inline-block;
}
.sendbtn{
	background-color: white;
	color: black;
	border:none;
	font-size: 1.25em;
	display: inline-block;
	margin: auto 0;
	margin-top:2%;
	margin-bottom: 3%;
	width:70%;
}
td form{
	display: inline-block;
	border:none;
}
.alerttable{
	width: 70%;
	height: auto;
	margin: 0 auto;
}
.alerttable td{
	display: inline-block;
}
.alert{
	font-size:1.25em;
	font-weight:bold;
	color: red;
}
.alertbtn{
	border: none;
	background-color: red;
	color: white;
	font-size: 1.5em;
}
.ordertable{
	border: 2px white solid;
	width: 70%;
	height: auto;
	margin: 0 auto;
	text-align: center;
	font-size: 1.25em;
	
}
.tablediv{
	text-align: center;
}
.alertdiv{
	text-align: center;
}
</style>
</head>
<body>
<?php
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
$sql = "SELECT * FROM alert";
$result1 = $conn->query($sql);
echo "<div class = 'alertdiv'><table class= 'alerttable'>";
if ($result1 -> num_rows >0){
		while ($row = $result1->fetch_assoc()){
			echo "<tr><td class = 'alert'> Assistance Needed at Table " . $row["tableno"] . "</td>
				<td><form method ='post' action =''><input class = 'alertbtn' type='submit' name= 'action' value= 'Attend'/><input type='hidden' name ='id' value = ". $row["tableno"]. "/></form></td></tr>";
		}
		echo "</table></div>";
	}
if ($_POST['action'] && $_POST['id']) {
		if ($_POST['action'] == 'Attend') {
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
			$sql = "DELETE FROM alert WHERE tableno = '$var1';";
			$conn->query($sql);
			$conn->close();
			header("Location: bar.php");
	}
}
$array = array (1, 2, 3, 4, 5);
foreach($array as $value){
	$sql1 = "SELECT * FROM orders WHERE tableno = '$value' and f_or_d = 'D'";
	$result = $conn->query($sql1);
	echo "<div class ='tablediv'><table class = 'ordertable'>";
	if ($result -> num_rows >0){
		echo "<th class = 'orderHead'>Table " . $value . "</th>";
		while ($row = $result->fetch_assoc()){
			echo "<tr><td>" . $row["item_name"] . "</td></tr>";
		}
		echo "</table>";
		echo "<form method='post' action =''><input class='sendbtn' type='submit' name ='action' value= 'Send'/>
			<input type='hidden' name ='id' value ='$value'/>
			</form></div>";
	}
	else {
	}
	mysqli_close();
}
if ($_POST['action'] && $_POST['id']) {
		if ($_POST['action'] == 'Send') {
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
			$sql = "DELETE FROM orders WHERE f_or_d = 'D' AND tableno = '$var1';";
			$conn->query($sql);
			$conn->close();
			header("Location: bar.php");
	}
}
?>
</div>
</body>
</html>