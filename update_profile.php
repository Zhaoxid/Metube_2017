<!DOCTYPE HTML>

<?php
	session_start();
	include_once "function.php";

if(isset($_POST['submit'])) {
	$check = user_pass_check($_SESSION['username'],$_POST['oldpwd']);

	if ($check == 2) {
        $update_error = "Incorrect old password.";
        echo $update_error;
        exit(-1);
	}
	if( $_POST['newpwd1'] != $_POST['newpwd2']) {
		$update_error = "New passwords don't match. Try again.";
		echo $update_error;
		exit(-1);
	}
	$newpassword = $_POST['newpwd1'];
	$username = $_SESSION['username'];
	$query = "update account set password='$newpassword' where username='$username'";
    $result = mysql_query($query);
    if(!$result) die("error changing password.".mysql_error());

	echo "<script type='text/javascript'>alert('Changed successfully!')</script>";
}
?>

<html>
<head>
		<title> Update Profile </title>
</head>

<body>
	<?php 
    if(empty($_SESSION['username'])){
      Print '<script>alert("User not found");</script>'; 
      Print '<script>window.location.assign("index.php");</script>';
   	 }
 	?>
<p>Welcome <?php echo $_SESSION['username'];?>!</p>

<a href='browse.php'  style="color:#FF9900;">Return</a> <br><br>

<h4> Change Password</h4>
<form action="update_profile.php" method="post" >
        Old Password: <input type="password" name = "oldpwd" required></input><br/>
        New Password:<input type="password" name = "newpwd1" required></input><br/>
        Confirm password:<input type="password" name = "newpwd2" required></input><br/>
        <input value="Submit" name="submit" type="submit"/>
</form>

<?php
  if(isset($update_error))
   {  echo "<div id='passwd_result'> update_error:".$update_error."</div>";}
?>


</body>
</html>