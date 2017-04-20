<!DOCTYPE html>
<?php
session_start();
include_once "function.php";
if(empty($_SESSION['username'])){
    Print '<script>alert("User not found");</script>';
    Print '<script>window.location.assign("index.php");</script>';
}
$request = 0;
?>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/default.css" />

<head>

<!-- Sidebar -->
<nav class="w3-sidebar w3-bar-block w3-collapse w3-large w3-theme-l5 w3-animate-left" style="z-index:3;width:250px;margin-top:43px;" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black w3-hide-large" title="Close Menu">
    <i class="fa fa-remove"></i>
  </a>
  <h4 class="w3-bar-item"><b>Menu</b></h4>
  <a class="w3-bar-item w3-button w3-hover-black" href='browse.php'>Browse</a> <br>
  <a class="w3-bar-item w3-button w3-hover-black" href='profile.php'>Profile</a> <br>
  <a class="w3-bar-item w3-button w3-hover-black" href='media_upload.php'>Upload File</a> <br>
  <a class="w3-bar-item w3-button w3-hover-black" href='playlist.php'>Playlist</a> <br>
  <a class="w3-bar-item w3-button w3-hover-black" href='message.php'>Message&Inbox</a> <br>
  <a class="w3-bar-item w3-button w3-hover-black" href='contacts.php'>Contacts</a><br>
  <a class="w3-bar-item w3-button w3-hover-black" href='logout.php'>Logout</a> <br>

</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>



</head>
<body>
<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:250px">

    <div class="w3-row w3-padding-64">
        <div class="w3-twothird w3-container">
            <h1 class="w3-text-teal">Playlists</h1>
<form action="create_playlist.php" method="post" ><input type="text" name="playlistname" placeholder="Enter Playlist Name" required>
<input value="Create Playlist" name="submit_playlist" type="submit" /></form><br>

<?php
if(isset($_POST['playlist'])){
    $name = $_POST['playlistname'];
    $user = $_SESSION['username'];
    $check = playlistid_check($name, $user);

    $query = "SELECT * from playlist_media WHERE playlistid = '$check'";
    $result = mysql_query( $query );
    if (!$result){
        die ("Could not query the media table in the database: <br> />". mysql_error());
    }
    $request = 1;
}
?>
<?php
echo "<form method='post' action= 'playlist.php?playlist=".$request."'> ";
$query1 = "select * from playlist_user where username = '".$_SESSION['username']."';";
$result1 = mysql_query($query1) or die ("Could not access playlist table".mysql_error());
echo "<select name='playlistname'>";
while($row = mysql_fetch_array($result1) )
{
    echo "<option value='".$row[0]."'>".$row[0]."</option>";
}
echo  "</select>";
echo "<input value='select_playlist' name='playlist' type='submit'>";
echo "</form>";
?>
            <br><br>
<?php
if(isset($_POST['delete'])){
$name = $_POST['playlistname'];
$user = $_SESSION['username'];
$check = playlistid_check($name, $user);

$queryd = "delete from playlist_user WHERE playlistid = '$check'";

$resultd = mysql_query( $queryd );
if (!$resultd){
         die ("Could not query the media table in the database: <br> />". mysql_error());
}
$request = 2;
}
?>





<?php
    if ($request == 1) {

?>
<table>
    <tr>
        <th> Username </th>
        <th> File title</th>
        <th> Download </th>
    </tr>
    <?php

    while ($result_row = mysql_fetch_row($result)) {
        $mediaid = $result_row[1];
        $query2 = "SELECT * from media WHERE mediaid = '$mediaid'";
        $result2 = mysql_query( $query2 );
        if (!$result2){
            die ("Could not query the media table in the database: <br> />". mysql_error());
        }
        $result2_row = mysql_fetch_row($result2);

        $filename = $result2_row[0];
        $filenpath = $result2_row[4];
        $username = $result2_row[1];
        $title=$result2_row[6];
        ?>
        <tr>
            <td>
                <?php
                echo $username;  //mediaid
                ?>
            </td>
            <td>
                <a href="media.php?id=<?php echo $mediaid;?>" target="_blank"><?php echo $title;?></a>
            </td>
            <td>
                <a href="<?php  echo $filenpath;?>" target="_blank" onclick="javascript:saveDownload(<?php echo $result2_row[4];?>);">Download</a>
            </td>
        </tr>

        <?php
    }
    ?>
</table>
<?php
}
?>















</body>
</html>
