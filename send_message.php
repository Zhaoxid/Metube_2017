<?php
    session_start();
    include_once "function.php";

	$sduser = $_SESSION['username'];
	$subj = $_POST['subj'];
	$msg = $_POST['msg'];
	$rcvuser = $_POST['rcvusername'];

    $check = user_exist($rcvuser);

	if($check == 2) {
        echo "Error sending message! Username does not exist!";
        exit(-1);
    }

    $insert = "insert into message(message, subj, sdusername, rcvusername, msgid)".
    "values('$msg','$subj','$sduser','$rcvuser', NULL)";

	$insertresult = mysql_query($insert);

	if(!$insertresult) {
        echo "insert error";
        exit(-1);
    }

	echo "<script type=\"text/javascript\">setTimeout(\"window.close();\", 1000);</script>Message sent!";
?>