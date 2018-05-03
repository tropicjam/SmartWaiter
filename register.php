<!DOCTYPE html> 
<html lang="en">
<head>
<title>Smart Waiter</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/styles.css">
<style>
.loginhere{
	color: #0043af;
}
.logwrapper{ width: 70%; padding: 20px; margin: 0 auto; }
body{ 
	text-align:center;
	margin-top:7%;
}
footer{
	position:absolute;
	bottom:0;
	width:100%;
}
label{
	font-size:1.75em;
}
.logbutton{
	border:none;
	background-color:#0043af;
	color:white;
	padding: 8%;
	width:50%;
	font-size:1.5em;
}
#regsubbtn{
	padding:5%;
	border:none;
	background-color:#0043af;
	color:white;
	width:40%;
}
#regsubbtn:hover{
	cursor:pointer
}
#ressubbtn{
	padding:5%;
	border:none;
	background-color:#0043af;
	color:white;
	width: 40%;
}
#ressubbtn:hover{
	cursor:pointer
}
.loginhere:hover{
	color: black;
}
.logerror{
	font-size: 1.5em;
	color:red;
}
</style>
</head>
<body>
<header>
	<nav class="navbar navbar-default sticky-top">
	  <div class="container-fluid">
		<ul class="nav navbar-nav">
		  <li></li>
		</ul>
		<div class="navbar-header">
		  <a class="navbar-brand" href="home.php"><img class = "logo" src= "images/white_logo.png" alt = "Smart Waiter"></a>
		</div>
		<ul class="nav navbar-nav">
		  <li></li>
		</ul>
	  </div>
	</nav>
</header>
<main onclick="closeNav()">
    <div class="logwrapper">
        <h1 class= "logheader">Sign Up</h1>
        <h5>Please fill this form to create an account.</h5>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username*</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" required>
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password*</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" required>
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password*</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>" required>
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" id="regsubbtn" value="Submit">
                <input type="reset"  id="ressubbtn" value="Reset">
            </div>
            <h5>Already have an account? <a class = "loginhere" href="login.php">Login here</a>.</h5>
		</form>
	</div>
</main>
<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                   echo "<p class ='logerror'>This username is already taken.</p>";
				   $username_err = 'This username is already taken.';
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo 'Oops! Something went wrong. Please try again later.';
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST['password']))){
        echo "<p class = 'logerror'>Please enter a password.</p>"; 
		$password_err = 'Please enter a password.';
    } elseif(strlen(trim($_POST['password'])) < 6){
        echo"<p class = 'logerror'>Password must have atleast 6 characters.</p>";
		$password_err = 'Password must have atleast 6 characters.';
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        echo "<p class = 'logerror'>Please confirm password.</p>"; 
		$confirm_password_err = 'Please confirm password.';
    } 
	else{
		$confirm_password = trim($_POST['confirm_password']);
	}
	if(strcmp($password, $confirm_password) == 1){
		echo "<p class = 'logerror'>Password did not match.</p>";
		$confirm_password_err = 'Password did not match.';
	}
    
	if(($confirm_password == $password) and (strlen(trim($password)) < 6 )){
		echo "<p class = 'logerror'>Password is under six characters.</p>";
		$confirm_password_err = 'Password is under six characters.';
	}
    if($confirm_password != $password){
		echo "<p class = 'logerror'>Passwords do not match.</p>";
		$confirm_password_err = 'Password does not match.';
	}
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: index.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         else{
			
		 }
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
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
</footer>
</body>
</html>