<html>
<body>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/default.css" />


<?php
session_start();
include_once "function.php";


if(isset($_POST['submit'])) {
	if( $_POST['passowrd1'] != $_POST['passowrd2']) {
		$register_error = "Passwords don't match. Try again?";
	}
	else {
		$check = user_exist_check($_POST['username'], $_POST['passowrd1']);	
		if($check == 1){
			//echo "Rigister succeeds";
			$_SESSION['username']=$_POST['username'];
			header('Location: browse.php');
		}
		else if($check == 2){
			$register_error = "Username already exists. Please user a different username.";
		}
	}
}

?>

<!-- Sidebar -->
<nav class="w3-sidebar w3-bar-block w3-collapse w3-large w3-theme-l5 w3-animate-left" style="z-index:3;width:250px;margin-top:43px;" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black w3-hide-large" title="Close Menu">
    <i class="fa fa-remove"></i>
  </a>
  <h4 class="w3-bar-item"><b>Menu</b></h4>
  <a class="w3-bar-item w3-button w3-hover-black" href='login.php'>Login</a> <br>
  <a class="w3-bar-item w3-button w3-hover-black" href='register.php'>Register</a> <br>
  <a class="w3-bar-item w3-button w3-hover-black" href='browse.php'>Browse</a> <br>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>


<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:250px">

  <div class="w3-row w3-padding-64">
    <div class="w3-twothird w3-container">
      <h1 class="w3-text-teal">Register</h1>
        </form>


<form action="register.php" method="post">
	Username: <input type="text" name="username"> <br>
	Create Password: <input  type="password" name="passowrd1"> <br>
	Repeat password: <input type="password" name="passowrd2"> <br>
	<input name="submit" type="submit" value="Submit">
</form>

<?php
  if(isset($register_error))
   {  echo "<div id='passwd_result'> register_error:".$register_error."</div>";}
?>

</body>
</html>
