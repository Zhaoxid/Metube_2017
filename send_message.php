<?php
	include "header.php";
	include_once "function.php";

	$query = "SELECT id FROM `user` WHERE `username` = '$username'";
	$result = mysql_query($query);

	if(!$result) {
        echo "Error sending message! Username does not exist!";
        exit(-1);
    }

	$row = mysqli_fetch_row($result);

	$uid = $row[0];
	$mid = rand();
	$sid = $_SESSION['id'];
	$query = "INSERT INTO message(massage, subj, sdusername, rcvusername, msgid, ts)  
    VALUES ('$message', '$subj', '$sdusername', '$rcvusername', NULL, now());";
	$result = mysql_query($query);

	if(!$result) {
        echo "Error sending message!";
        exit(-1);
    }

	echo "<script type=\"text/javascript\">setTimeout(\"window.close();\", 1000);</script>Message sent!";
?>