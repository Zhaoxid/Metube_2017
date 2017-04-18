<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
	include_once "function.php";
?>	
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media</title>
<script src="Scripts/AC_ActiveX.js" type="text/javascript"></script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<style>
    td, th {
        text-align: center;
        padding:4px;
    }
</style>
</head>

<body>
<?php
if(isset($_GET['id'])) {
	$query = "SELECT * FROM media WHERE mediaid='".$_GET['id']."'";
	$result = mysql_query( $query );
	$result_row = mysql_fetch_row($result);
	
	//updateMediaTime($_GET['id']);
	
	$filename=$result_row[0];   ////0, 4, 2
	$filepath=$result_row[4]; 
	$type=$result_row[2];
	$description=$result_row[5];
	$title=$result_row[6];
	if(substr($type,0,5)=="image") //view image
	{
		?> <h2><?php echo "Viewing Picture:";
		echo $title; ?></h2>
		<p><?php echo "<img src='".$filepath."'/>"; ?></p>
		<h3>Description:</h3>
		<p><?php echo $description;?></p><?php
	}
	else //view movie
	{	
?>
	<!-- <p>Viewing Video:<?php echo $result_row[2].$result_row[1];?></p> -->
	<h2>Viewing Video:<?php echo $result_row[6];?></h2>

<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" width="550"
height="400" id="MediaPlayer">
<param name=movie value="<?php echo $result_row[4];?>">
<param name=quality value=high>
<param name=bgcolor value=#FFFFFF>
<embed src="<?php echo $filepath; ?>"
quality=high bgcolor=#FFFFFF width="550" height="400"
name="myMovieName" align="" type="application/xshockwave-flash"
PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></embed>
</object>

<h3>Description:</h3>
<p><?php echo $result_row[5];?></p>      
              
<?php
	}
}
else
{
?>
<meta http-equiv="refresh" content="0;url=browse.php">
<?php
}
?>

Comment:
<form action="submit_comment.php?id=<?php echo $_GET['id'];?>" method="POST">
    <textarea name="comment" cols="80" rows="8" placeholder="Type the Comment"></textarea><br/>
    <input type="submit" value="Send">
</form>
<br/><br/>
<?php
$query = "SELECT * from comments where mediaid = '".$_GET['id']."' order by ts DESC";
$result = mysql_query( $query );
if (!$result){
    die ("Could not query the media comment table in the database: <br />". mysql_error());
}
?>

<table>
    <col width="100">
    <col width="135">
    <col width="530">

    <tr>
        <th> Username </th>
        <th> Date </th>
        <th> Comment </th>
    </tr>
    <?php
    while ($result_row = mysql_fetch_row($result)) {
        ?>
        <tr>
            <td> <?php echo $result_row[1];?></td>
            <td> <?php echo $result_row[3];?></td>
            <td> <?php echo $result_row[0];?></td>
        </tr>
        <?php
    } ?>
</table>

</body>
</html>
