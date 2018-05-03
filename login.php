<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Smart Waiter</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/styles.css">
<style>
.loginhere{
	color: #0043af;
	}
body{ 
	text-align:center;
	margin-top:10%;
	}
.logwrapper{ 
	width: 70%; 
	padding: 20px; 
	margin: 0 auto; 
}
option{
	text-align:center;
}
.navbar{
	background-color: #0043af;
	color: white;
	overflow: hidden;
	position: fixed;
	top: 0;
	width: 100%;
}
body{ 
	text-align:center;
	padding-top:5%;
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
.logerror{
	font-size: 1.5em;
	color:red;
}
</style>
</head>
<body>
<header>
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
		<ul class="nav navbar-nav">
		  <li><a href="#"></a></li>
		</ul>
		<div class="navbar-header">
			<a class="navbar-brand" href="home.php"><img class = "logo" src= "images/white_logo.png" alt = "Smart Waiter"></a>
		</div>
			<ul class="nav navbar-nav">
			  <li><a href= "#"></a></li>
			</ul>
	  </div>
	</nav>
</header>
<main>
    <div class="logwrapper">
        <h1 class="logheader">Login</h1>
        <h5>Please fill in your credentials to login.</h5>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username*</label>
                <input type="text" name="username" class="form-control" required value="<?php echo $username; ?>">
            </div>    
            <div class="form-group">
                <label>Password*</label>
                <input type="password" name="password" class="form-control" required>
            </div>
			<div class = "form-group">
				<label>Select your Table Number*</label>
				<select class = "form-control" id = "self1" name = "table">
					<option value="">Select Table Number</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
				<span class= "error"><?php echo $tableErr;?></span>
			</div>
            <div class="form-group">
                <input type="submit" class= "logbutton" value="Login">
            </div>
            <h5>Don't have an account? <a class = "loginhere" href="register.php">Sign up now</a>.</h5>
        </form>
    </div>
</main>	
<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$username = $password = "";
$usernameErr = $passwordErr = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        echo "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $passwordErr = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }
    if (empty(trim($_POST['table']))){
		echo "<p class= 'logerror'>Please enter a table number</p>";
	}else{
		$table = $_POST['table'];
	}
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            /* Password is correct, so start a new session and
                            save the username to the session */
							if ($_POST['table'] != ''){
								session_start();
								$_SESSION['username'] = $username; 
								$_SESSION['table'] = $table;	
								header("location: home.php");
							}
                        } else{
                            // Display an error message if password is not valid
                            echo "<p class = 'logerror'>The password you entered was not valid.</p>";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    echo "<p class = 'logerror'>No account found with that username.</p>";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
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