<html>
<?php
session_start();
include_once "function.php";

$mediaid = $_GET['id'];
$username=$_SESSION['username'];
$query = "SELECT * from media where mediaid = '$mediaid'";
$resultq = mysql_query($query);
$result_row = mysql_fetch_row($resultq);
$path = $result_row[4];
unlink($path);
$deleteMedia="delete from media where mediaid = '$mediaid'";
$resultd = mysql_query($deleteMedia);

if(!$resultd) {
    echo "delete error";
}
?>
<meta http-equiv="refresh" content="0; url=profile.php" />
</html>