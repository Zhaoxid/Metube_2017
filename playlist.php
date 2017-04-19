<!DOCTYPE html>
<?php
session_start();
include_once "function.php";
?>

<head>
    <title> Playlist</title>
</head>
<body>
<p class="bold">Welcome to metube, <?php echo $_SESSION['username'];?>!</p></br>

<form action="create_playlist.php" method="post" ><input type="text" name="playlistid" placeholder="Enter Playlist Name" required>
<input value="Create Playlist" name="submit_playlist" type="submit" /></form>

















</body>
</html>