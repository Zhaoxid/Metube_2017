<?php
session_start();
include_once "function.php";

if(empty($_SESSION['username'])){
    Print '<script>alert("User not found");</script>';
    Print '<script>window.location.assign("index.php");</script>';
}

if(isset($_GET['id'])) {
    $user2 = $_GET['id'];
    $username = $_SESSION['username'];
    $deleteContact = "delete from contacts where username1 = '$username' and username2 = '$user2'";
    $resultd = mysql_query($deleteContact);
}
if(!$resultd) {
    echo "delete error";
}
?>
<html>
<meta http-equiv="refresh" content="0; url=contacts.php" />
</html>