<!DOCTYPE html> 
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<meta http-equiv="refresh" content="5">
<title>Kitchen Application</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/backend.css">
<style>
body{
	background-color:black;
}
.col-sm-4
{
	border:1px white solid;
}
h3{
	color:white;
	border: white 1px solid;
}
table{
	color: white;
	border: white 1px solid;
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
.col-sm-2{
	margin-top:2%;
	background-color: white;
	color: black;
	border:none;
	margin-bottom: 3%;
	display: inline-block;
}
.customise{
	text-align:right;
	color:red;
}
p{
	color: white;
}
.ordertable{
	border: 2px white solid;
	width: 70%;
	height: auto;
	margin: 0 auto;
	text-align: center;
	font-size: 1.25em;
	
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
.tablediv{
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
$tablearray = array (1, 2, 3, 4, 5);
foreach($tablearray as $value){
	$sql1 = "SELECT * FROM orders WHERE tableno = '$value' and f_or_d = 'F'";
	$result = $conn->query($sql1);
	echo "<div class = 'tablediv'><table class = 'ordertable'>";
	if ($result -> num_rows >0){
		echo "<th class = 'orderHead'>Table " . $value . "</th>";
		while ($row = $result->fetch_assoc()){
			echo "<tr><td>" . $val . "</td></tr>";
			echo "<tr><td>" . $row["item_name"] . "</td></tr>";
			echo "<tr><td class = 'customise'>"	. $row["customise"] . "</td></tr>";
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
			$sql = "DELETE FROM orders WHERE f_or_d = 'F' AND tableno = '$var1';";
			$conn->query($sql);
			$conn->close();
			header("Location: kitchen.php");
	}
}
?>
</div>
</body>
</html>