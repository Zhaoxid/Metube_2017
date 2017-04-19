<?php
session_start();
include_once "function.php";

if(empty($_SESSION['username'])){
    Print '<script>alert("User not found");</script>';
    Print '<script>window.location.assign("index.php");</script>';
}

if(isset($_POST['submit_playlist']))	{
    $name = $_POST['playlistname'];
    $user = $_SESSION['username'];

    $check = playlist_check($name, $user);

    if ($check == 2) {
        Print '<script>alert("Playlist already exist!");</script>';
        Print '<script>window.location.assign("playlist.php");</script>';
    }
    else {
        $query = "insert into playlist_user values ('$name','$user', NULL);";
        $result = mysql_query($query);
        if (!$result) {
            die("create failed.<br/>" . mysql_error());
            Print '<script>alert("Create playlist failed");</script>';
            Print '<script>window.location.assign("playlist.php");</script>';
        }

        Print '<script>alert("Playlist created!");</script>';
        Print '<script>window.location.assign("playlist.php");</script>';
    }
}
?>
