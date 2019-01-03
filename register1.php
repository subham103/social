<?php
// Start the session
session_start();
?>

<?php  
$con = mysqli_connect("localhost", "root", "", "social"); //Connection variable

if(mysqli_connect_errno()) 
{
	echo "Failed to connect: " . mysqli_connect_errno();
}

//Declaring variables to prevent errors
$fname = ""; //First name
$lname = ""; //Last name
$em = ""; //email
$password = ""; //password
$password2 = ""; //password 2
$date = ""; //Sign up date 
$error_array = array(); //Holds error messages

if(isset($_POST['signupbtn'])){

	//Registration form values

	//First name
	$fname = ppr($_POST['reg_fname']);
	// $fname = str_replace(' ', '', $fname); //remove spaces
	// $fname = ucfirst(strtolower($fname)); //Uppercase first letter
	$_SESSION['reg_fname'] = $fname; //Stores first name into session variable

	//Last name
	$lname = ppr($_POST['reg_lname']);
	// $lname = str_replace(' ', '', $lname); //remove spaces
	// $lname = ucfirst(strtolower($lname)); //Uppercase first letter
	$_SESSION['reg_lname'] = $lname; //Stores last name into session variable

	//email
	$em = strip_tags($_POST['reg_email']); //Remove html tags
	$em = str_replace(' ', '', $em); //remove spaces
	$em = ucfirst(strtolower($em)); //Uppercase first letter
	$_SESSION['reg_email'] = $em; //Stores email into session variable

	//Password
	$password = strip_tags($_POST['reg_password']); //Remove html tags
	$password2 = strip_tags($_POST['reg_password2']); //Remove html tags

	$date = date("Y-m-d"); //Current date

		//Check if email is in valid format 
		if(filter_var($em, FILTER_VALIDATE_EMAIL)) {

			$em = filter_var($em, FILTER_VALIDATE_EMAIL);

			//Check if email already exists 
			$e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

			//Count the number of rows returned
			$num_rows = mysqli_num_rows($e_check);

			if($num_rows > 0) {
				array_push($error_array, "Email already in use<br>");
			}

		}else {
			array_push($error_array, "Invalid email format<br>");
		}

	if($password != $password2) {
		array_push($error_array,  "Your passwords do not match<br>");
	}
	else {
		if(preg_match('/[^A-Za-z0-9]/', $password)) {
			array_push($error_array, "Your password can only contain english characters or numbers<br>");
		}
	}

	if(strlen($password > 30 || strlen($password) < 5)) {
		array_push($error_array, "Your password must be betwen 5 and 30 characters<br>");
	}


	if(empty($error_array)) {
		$password = md5($password); //Encrypt password before sending to database

		//Generate username by concatenating first name and last name
		$username = strtolower($fname . " " . $lname);
		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");


		$i = 0; 
		//if username exists add number to username
		while(mysqli_num_rows($check_username_query) != 0) {
			$i++; //Add 1 to i
			$username = $username . " " . $i;
			$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
		}

		//Profile picture 
		$rand = rand(1, 16); //Random number between 1 and 16

		switch ($rand) {
			case 1:
				# code...
				$profile_pic = "head_alizarin.png";
				break;
			
			case 2:
				# code...
				$profile_pic = "head_amethyst.png";
				break;

			case 3:
				# code...
				$profile_pic = "head_belize_hole.png";
				break;

			case 4:
				# code...
				$profile_pic = "head_carrot.png";
				break;

			case 5:
				# code...
				$profile_pic = "head_deep_blue.png";
				break;
			
			case 6:
				# code...
				$profile_pic = "head_emerald.png";
				break;
			
			case 7:
				# code...
				$profile_pic = "head_green_sea.png";
				break;
			
			case 8:
				# code...
				$profile_pic = "head_nephritis.png";
				break;
			
			case 9:
				# code...
				$profile_pic = "head_pete_river.png";
				break;
			
			case 10:
				# code...
				$profile_pic = "head_pomegranate.png";
				break;
			
			case 11:
				# code...
				$profile_pic = "head_pumpkin.png";
				break;
			
			case 12:
				# code...
				$profile_pic = "head_red.png";
				break;
			
			case 13:
				# code...
				$profile_pic = "head_sun_flower.png";
				break;
			
			case 14:
				# code...
				$profile_pic = "head_turqoise.png";
				break;
			
			case 15:
				# code...
				$profile_pic = "head_wet_asphalt.png";
				break;
			
			case 16:
				# code...
				$profile_pic = "head_wisteria.png";
				break;
			
		}


		$query = "INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `signup_date`, `profile_pic`, `num_posts`, `num_likes`, `user_closed`, `friend_array`) VALUES (NULL, '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',');";

		if (mysqli_query($con, $query)) {
			# code...
			echo "new record created succssesfully";
		}else{
			echo "Error: " . $query . "<br>" . mysqli_error($conn);
		}

		array_push($error_array, "<span style='color: #14C800;'>You're all set! Goahead and login!</span><br>");

		//Clear session variables 
		$_SESSION['reg_fname'] = "";
		$_SESSION['reg_lname'] = "";
		$_SESSION['reg_email'] = "";
		$_SESSION['reg_email2'] = "";
	}

}

function ppr($data) {
  $data = strip_tags($data);
  $data = str_replace(' ', '', $data);
  $data = ucfirst(strtolower($data));
  return $data;
}

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
	  padding: 10px 12px;
	  margin: 8px 0;
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

	</form>


</body>
</html>
