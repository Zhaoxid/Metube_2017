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
    if (!$sduser) {
        echo "Please enter a receiver username!";
        exit(-1);
    }

    if (!$subj) {
	    echo "Please enter subject!";
	    exit(-1);
    }

    if (!$msg) {
	    echo "Please enter the message!";
	    exit(-1);
    }

    if ($rcvuser == $sduser) {
	    echo "Cannot send a message to yourself!";
	    exit(-1);
    }
    $insert = "insert into message(message, subj, sdusername, rcvusername, msgid, ts)".
    "values('$msg','$subj','$sduser','$rcvuser', NULL, NULL)";

	$insertresult = mysql_query($insert);

	if(!$insertresult) {
        echo "insert error";
        exit(-1);
    }

	echo "<script type=\"text/javascript\">setTimeout(\"window.close();\", 1000);</script>Message sent!";
?>