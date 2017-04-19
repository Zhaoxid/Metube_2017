<!DOCTYPE html>
<?php
session_start();
include_once "function.php";
$request = 0;
?>

<head>
    <title> Playlist</title>
</head>
<body>
<p class="bold">Welcome to metube, <?php echo $_SESSION['username'];?>!</p></br></br>

<a href='browse.php'  style="color:#FF9900;">Return</a> <br><br>
<form action="create_playlist.php" method="post" ><input type="text" name="playlistname" placeholder="Enter Playlist Name" required>
<input value="Create Playlist" name="submit_playlist" type="submit" /></form>


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