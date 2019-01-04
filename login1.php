<?php 
	require 'configuration.php';
	// require 'signup.php';
	require 'login.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<style>
		body {
		  font-family: Arial, Helvetica, sans-serif;
		}
		* {box-sizing: border-box}


		/* Full-width input fields */
		input[type=text], input[type=password] {
		  width: 100%;
		  padding: 15px;
		  margin: 5px 0 5px 0;
		  display: inline-block;
		  border: none;
		  background: #f1f1f1;
		}

		input[type=text]:focus, input[type=password]:focus {
		  background-color: #ddd;
		  outline: none;
		}

		hr {
		  border: 1px solid #f1f1f1;
		  /*margin-bottom: 25px;*/
		}

		/* Set a style for all buttons */
		.signupbtn {
		  background-color: #4CAF50;
		  color: white;
		  padding: 10px 12px ;
		  margin: 8px 0 0 0;
		  border: none;
		  cursor: pointer;
		  width: 70%;
		  opacity: 0.9;
		}

		.signupbtn:hover {
		  opacity:1;
		}

		#form{
		  border:1px solid #ccc;
		  width: 400px;
		  text-align: center;
		  /*border:1px solid red;*/
		  margin:0 auto;
		  position: relative;
		  top: 150px;
		}

		/* Add padding to container elements */
		.container {
		  padding: 16px;
		  width: 70%;
		  //height: 400px;
		  display: block;
		  margin: 0 auto;
		}

		/* Clear floats */
		.clearfix::after {
		  content: "";
		  clear: both;
		  display: table;
		}

		.signup{
			color: blue;
			text-align: center;
			margin-top: 0;
		}

		.signup a{
			text-decoration: none;
			cursor: pointer;
		}
	</style>
</head>
<body>
	<form action="/login1.php" method="POST" id="form">
		<div class="container">
			<h3>Log In</h3>
			<hr>
			<input type="text" name="log_email" placeholder="Email" value="<?php 
			if(isset($_SESSION['log_email'])) {
				echo $_SESSION['log_email'];
			} 
			?>" required>
			<br>
			
			<?php 

			 ?>

			<input type="password" name="log_password" placeholder="Password" required>
			<br>

			<div class="clearfix">
				<input type="submit" name="login_btn" class="signupbtn" value="Login">
			</div>
			
			<?php 
				if (in_array("Email or password was incorrect<br>", $error_array)) {
					echo "Email or password was incorrect<br>";
				}
			 ?>
			<br>
		</div>

		<div class="signup">
			<a href="/register1.php">Sign Up?</a>
		</div>
	</form>
</body>
</html>