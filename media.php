<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
	include_once "function.php";
?>	
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/default.css" />
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

<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main">
  <div class="w3-row w3-padding-64">
    <div class="w3-twothird w3-container">
        <table width="75%" cellpadding="0" cellspacing="0">

<?php
if(isset($_GET['id'])) {
	$query = "SELECT * FROM media WHERE mediaid='".$_GET['id']."'";
	$result = mysql_query( $query );
	$result_row = mysql_fetch_row($result);
	
    //update view count
	mysql_query("UPDATE media SET views = views + 1 WHERE mediaid='".$_GET['id']."'");
	
	$filename=$result_row[0];   
	$filepath=$result_row[4]; 
	$type=$result_row[2];
	$description=$result_row[5];
	$title=$result_row[6];
	if(substr($type,0,5)=="image") //view image
	{
		?> <h2><?php echo "Viewing Picture: ";
		echo $title; ?></h2>
		<img src="<?php echo $filepath; ?>" width = "640" height = "320" >
		<h3>Description:</h3>
		<p><?php echo $description;?></p><?php
	}
	else //view movie
	{
?>	

	<!-- <p>Viewing Video:<?php echo $result_row[2].$result_row[1];?></p> -->
	<h2> <?php if (substr($type,0,5)=="video") { echo "Viewing Video: "; }
		else { echo "Viewing File: "; } ?>
	<?php echo $result_row[6];?></h2>

        <object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" width="640" height="320" codebase="http://www.apple.com/qtactivex/qtplugin.cab#version=6,0,2,0" align="middle" >
            <param name="src" value="<?php echo $result_row[4];?>" />
            <param name="autoplay" value="true" />
            <embed src="<?php echo $result_row[4];?>" width="640" height="320" pluginspage=http://www.apple.com/quicktime/download/ align="middle" autoplay="true" bgcolor="black" >
            </embed>
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

<?php if(!empty($_SESSION['username'])){ ?>

<form action="submit_comment.php?id=<?php echo $_GET['id'];?>" method="POST">
    <textarea name="comment" cols="80" rows="8" placeholder="Type the Comment"></textarea><br/>
    <input type="submit" value="Send">
</form>
<br/><br/>
<?php } ?>
<?php
$query = "SELECT * from comments where mediaid = '".$_GET['id']."' order by ts DESC";
$result = mysql_query( $query );
if (!$result){
    die ("Could not query the media comment table in the database: <br />". mysql_error());
}
?>

<table>
    <col width="100">
    <col width="160">
    <col width="400">

    <tr>
        <th align="left"> Username </th>
        <th align="left"> Date </th>
        <th align="left"> Comment </th>
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
</table>
</body>
</html>
