<!DOCTYPE HTML>
<?php
session_start();
include_once "function.php";
if(empty($_SESSION['username'])) {
    Print '<script>alert("User not found");</script>';
    if (isset($_GET['id'])) {
        $mediaid = $_GET['id'];
    }
} else {
    if (isset($_GET['id'])) {
        $mediaid = $_GET['id'];
    }
    $username = $_SESSION['username'];
    $cmt = $_POST['comment'];

    if (!$cmt) {
        echo "Please enter the comment!";
        exit(-1);
    }

    $insert = "insert into comments(cmt, username, mediaid, ts)" .
        "values('$cmt','$username', '$mediaid', NULL)";

    $insertresult = mysql_query($insert);

    if (!$insertresult) {
        echo "insert error";
        exit(-1);
    }

    echo "<script type='text/javascript'>alert('Changed successfully!')</script>";
?>
<meta http-equiv="refresh" content="0; url=media.php?id=<?php echo $mediaid;?>" />
<?php } ?>
</html>