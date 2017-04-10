<!DOCTYPE HTML>
<?php
session_start();
include_once "function.php";

?>
<html>
<head>
    <title> Send Message </title>
</head>
<p>Welcome <?php echo $_SESSION['username'];?>!</p>



<body>
<a href='browse.php'  style="color:#FF9900;">Return</a> <br><br>

<button onclick="window.open('create_message.php', 'newwindow', 'width=800, height=500'); ">Create New Message</button>

</body>
</html>


