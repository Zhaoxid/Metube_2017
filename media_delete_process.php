<html>
<?php
session_start();
include_once "function.php";

$mediaid = $_GET['id'];
$username=$_SESSION['username'];
echo $mediaid;
$deleteMedia="delete from media where mediaid = '$mediaid'";
$result = mysql_query($deleteMedia);
if(!$result) {
    echo "delete error";
    

}
?>
<meta http-equiv="refresh" content="0; url=profile.php" />
</html>