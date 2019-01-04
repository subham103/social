<?php
	require 'configuration.php';
	require 'signup.php';
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sign Up</title>
	<!-- <link rel="stylesheet" href="reg_style.css"> -->
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
		  top: 100px;
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

		.login{
			color: blue;
			text-align: center;
			margin-top: 0;
		}

		.login a{
			text-decoration: none;
			cursor: pointer;
		}
	</style>
</head>
<body>

	<form action="/register1.php" method="POST" id="form">
		
		<div class="container">
			<h3>Sign Up</h3>
			<hr>
			<input type="text" name="reg_fname" placeholder="First Name" value="<?php 
			if(isset($_SESSION['reg_fname'])) {
				echo $_SESSION['reg_fname'];
			} 
			?>" required>
			<br>
			
			<input type="text" name="reg_lname" placeholder="Last Name" value="<?php 
			if(isset($_SESSION['reg_lname'])) {
				echo $_SESSION['reg_lname'];
			} 
			?>" required>
			<br>
		
			<input type="text" name="reg_email" placeholder="Email" value="<?php 
			if(isset($_SESSION['reg_email'])) {
				echo $_SESSION['reg_email'];
			} 
			?>" required>
			<br>

			<?php if(in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>"; 
			else if(in_array("Invalid email format<br>", $error_array)) echo "Invalid email format<br>";
			?>

			<input type="password" name="reg_password" placeholder="Password" required>
			<br>
			<input type="password" name="reg_password2" placeholder="Confirm Password" required>
			<br>
			<?php if(in_array("Your passwords do not match<br>", $error_array)) echo "Your passwords do not match<br>"; 
			else if(in_array("Your password can only contain english characters or numbers<br>", $error_array)) echo "Your password can only contain english characters or numbers<br>";
			else if(in_array("Your password must be betwen 5 and 30 characters<br>", $error_array)) echo "Your password must be betwen 5 and 30 characters<br>"; ?>

			<div class="clearfix">
				<input type="submit" name="signupbtn" class="signupbtn" value="Register">
			</div>
			
			<br>
		</div>

		<?php if(in_array("<span style='color: #14C800;'>You're all set! Goahead and login!</span><br>", $error_array)) echo "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>"; ?>
		
		<div class="login">
			<a href="/login1.php">Sign In?</a>
		</div>

	</form>
	
	
</body>
</html>