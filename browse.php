<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
	include_once "function.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media Browse</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
<link rel="stylesheet" href="css/default.css" />
<script type="text/javascript" src="js/jquery-latest.pack.js"></script>
<script type="text/javascript">
function saveDownload(id)
{
	$.post("media_download_process.php",
	{
       id: id,
	},
	function(message)
    { }
 	);
}
</script>
</head>

<body>

<!--
<p>Welcome <?php echo $_SESSION['username'];?></p>

<a href='update_profile.php'  style="color:#FF9900;">Update Profile</a> <br>
<a href='media_upload.php'  style="color:#FF9900;">Upload File</a> <br>
<a href='message.php'  style="color:#FF9900;">Message&Inbox</a> <br>
<a href='contacts.php'  style="color:#FF9900;">Contacts</a><br>
<a href='index.php'  style="color:#FF9900;">Logout</a> <br>

<form action = "search.php" method="GET" >
	<input type = 'text' size='90' name='search' >
	<input type = 'submit' name='submit' value='Search files'>
</form>
-->

<!-- Sidebar -->
<nav class="w3-sidebar w3-bar-block w3-collapse w3-large w3-theme-l5 w3-animate-left" style="z-index:3;width:250px;margin-top:43px;" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black w3-hide-large" title="Close Menu">
    <i class="fa fa-remove"></i>
  </a>
  <h4 class="w3-bar-item"><b>Menu</b></h4>
  <a class="w3-bar-item w3-button w3-hover-black" href='profile.php'>Profile</a> <br>
  <a class="w3-bar-item w3-button w3-hover-black" href='media_upload.php'>Upload File</a> <br>
  <a class="w3-bar-item w3-button w3-hover-black" href='playlist.php'>Playlist</a> <br>
  <a class="w3-bar-item w3-button w3-hover-black" href='message.php'>Message&Inbox</a> <br>
  <a class="w3-bar-item w3-button w3-hover-black" href='contacts.php'>Contacts</a><br>
  <a class="w3-bar-item w3-button w3-hover-black" href='index.php'>Logout</a> <br>

</nav>
	
<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>


<div id='upload_result'>
<?php 
	if(isset($_REQUEST['result']) && $_REQUEST['result']!=0)
	{		
		echo upload_error($_REQUEST['result']);
	}
?>
</div>
<br/><br/>
<<<<<<< Updated upstream
=======
<?php
	$query = "SELECT * from media"; 
	$result = mysql_query( $query );
	if (!$result){
	   die ("Could not query the media table in the database: <br />". mysql_error());
	}
?>
>>>>>>> Stashed changes

<!-- Functions for sorting the files -->
<?php

if(isset($_REQUEST['TitleASC'])){
	$result = Title("ASC");	
	$status = "TitleDESC";
	
}
else if(isset($_REQUEST['TitleDESC'])){
        $result = Title("DESC");
	$status = "TitleASC";
}

else if(isset($_REQUEST['UsernameASC'])){
	$result = Username("ASC");
	$status = "UsernameDESC";
}

else if(isset($_REQUEST['UsernameDESC'])){
        $result = Username("DESC");
	$status = "UsernameASC";
}

else if(isset($_REQUEST['ViewsASC'])){
	$result = Views("ASC");
	$status = "ViewsDESC";
}

else if(isset($_REQUEST['ViewsDESC'])){
        $result = Views("DESC");
	$status = "ViewsASC";
}

else {
        $query = "SELECT * from media";
        $result = mysql_query( $query );
	$status = "blank";
        if (!$result){
           die ("Could not query the media table in the database: <br />". mysql_error());
        }
}
?>  

<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:250px">

  <div class="w3-row w3-padding-64">
    <div class="w3-twothird w3-container">
      <h1 class="w3-text-teal">Uploaded Media List</h1>
	<form action = "search.php" method="GET" > 
        <input type = 'text' size='90' name='search' >
        <input type = 'submit' name='submit' value='Search files'>
	</form>


<<<<<<< Updated upstream
	<table width="75%" cellpadding="0" cellspacing="0">
=======
	<table width="60%" cellpadding="0" cellspacing="0">
>>>>>>> Stashed changes
	<tr>
		<form>
		<th align="left">
                        <input type="submit" name=
                                "<?php if ($status == "UsernameDESC"){
                                                echo $status; }
                                        else { echo "UsernameASC"; } ?>"
                                value="Username">
			</th>
		<th align="left">
			<input type="submit" name=
				"<?php if ($status == "TitleDESC"){
						echo $status; }
				  	else { echo "TitleASC"; } ?>"
				value="File Title">
			</th>
		<th align="left">Download Link</th>
		<th align="left">
                        <input type="submit" name=
                                "<?php if ($status == "ViewsDESC"){
                                                echo $status; }
                                        else { echo "ViewsASC"; } ?>"
                                value="View Count">
			</th>
        <th align ="left"> Option </th>
		</form>
		<?php
			while ($result_row = mysql_fetch_row($result)) //filename, username, type, mediaid, path
			{ 
				$mediaid = $result_row[3];
				$filename = $result_row[0];
				$filenpath = $result_row[4];
				$username = $result_row[1];
				$title=$result_row[6];
		?>
        	 <tr valign="top">			
			    <td>
					<?php 
						echo $username;  //mediaid
					?>
		    	</td>
                 <td>
                     <a href="media.php?id=<?php echo $mediaid;?>" target="_blank"><?php echo $title;?></a>
                 </td>
                 <td>
                     <a href="<?php  echo $filenpath;?>" target="_blank" onclick="javascript:saveDownload(<?php echo $result_row[4];?>);">Download</a>
                 </td> 
				 <td>
					<?php echo $result_row[7]; ?>
				 </td>
                 <td>
                     <?php
                        echo "<form method='post' action= 'add_media_to_playlist.php?mediaid=".$mediaid."'> ";
                        $query1 = "select * from playlist_user where username = '".$_SESSION['username']."';";
                        $result1 = mysql_query($query1) or die ("Could not access playlist table".mysql_error());
                        echo "<select name='playlistname'>";
                          while($row = mysql_fetch_array($result1) )
                           {
                            echo "<option value='".$row[0]."'>".$row[0]."</option>";
                           }
                        echo  "</select>";
                        echo "</td>";
                        echo "<td>";
                        echo "<input value='Add to playlist' name='add_to_playlist' type='submit'>";
                        echo "</form>";
                     ?>
                 </td>
		    </tr>
        	<?php
			}
		?>
	</table>
   </div>
</body>
</html>
