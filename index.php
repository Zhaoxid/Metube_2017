<html>
<body>
<?php
echo "<h1> Welcome to Metube! </h1>";
$ts = time();
echo date('Y-m-d H:i:s', $ts);

?>

<form action="login.php" method="post">
	
	<input type="submit" class="button"  VALUE = "Log in" >
</form>

<form action="register.php" method="post">
	
	<input type="submit" class="button"  VALUE = "Register" >
</form>

</body>
</html>
