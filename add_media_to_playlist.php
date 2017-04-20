<?php
session_start();
include_once "function.php";

if(empty($_SESSION['username'])){
    Print '<script>alert("User not found");</script>';
    Print '<script>window.location.assign("index.php");</script>';
}

if(isset($_POST['add_to_playlist']))	{
    if(isset($_POST['playlistname'])) {
        $name = $_POST['playlistname'];
    }
    else {
        Print '<script>alert("Playlist does not exist");</script>';
        Print '<script>window.location.assign("browse.php");</script>';
    }
    $user = $_SESSION['username'];
    $mediaid = $_GET['mediaid'];

    $check = playlistid_check($name, $user);
    if ($check == 0) {
        die("add failed.<br/>" . mysql_error());
        Print '<script>alert("Playlist does not exist");</script>';
        Print '<script>window.location.assign("browse.php");</script>';
    }

    $query = "insert into playlist_media values ('$check','$mediaid');";
    $result = mysql_query($query);
    if (!$result) {
        die("add failed.<br/>" . mysql_error());
        Print '<script>alert("Add to playlist failed");</script>';
        Print '<script>window.location.assign("browse.php");</script>';
    }

    Print '<script>alert("Media added to playlist!");</script>';
    Print '<script>window.location.assign("browse.php");</script>';
}
?>
