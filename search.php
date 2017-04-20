<?php
	session_start();
	include_once "function.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media Search</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/default.css" />
<script type="text/javascript" src="js/jquery-latest.pack.js"></script>
<script type="text/javascript">
</script>

<!-- Sidebar -->
<nav class="w3-sidebar w3-bar-block w3-collapse w3-large w3-theme-l5 w3-animate-left" style="z-index:3;width:250px;margin-top:43px;" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black w3-hide-large" title="Close Menu">
    <i class="fa fa-remove"></i>
  </a>
  <h4 class="w3-bar-item"><b>Menu</b></h4>
  <a class="w3-bar-item w3-button w3-hover-black" href='profile.php'>Profile</a> <br>
  <a class="w3-bar-item w3-button w3-hover-black" href='browse.php'>Browse</a> <br>
  <a class="w3-bar-item w3-button w3-hover-black" href='media_upload.php'>Upload File</a> <br>
  <a class="w3-bar-item w3-button w3-hover-black" href='playlist.php'>Playlist</a> <br>
  <a class="w3-bar-item w3-button w3-hover-black" href='message.php'>Message&Inbox</a> <br>
  <a class="w3-bar-item w3-button w3-hover-black" href='contacts.php'>Contacts</a><br>
  <a class="w3-bar-item w3-button w3-hover-black" href='index.php'>Logout</a> <br>

</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

</head>

<body>

<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:250px">

  <div class="w3-row w3-padding-64">
    <div class="w3-twothird w3-container">
      <h1 class="w3-text-teal">Search</h1>
        <form action = "search.php" method="GET" >
        <input type = 'text' size='90' name='search' >
        <input type = 'submit' name='submit' value='Search files'>
        </form>

<?php
if(isset($_GET['search'])){
	$query1= "SELECT * FROM media WHERE title='".$_GET['search']."' OR username='".$_GET['search']."' OR mediaid IN (SELECT mediaid FROM tags WHERE tag='".$_GET['search']."')";
	
	$result1 = mysql_query($query1);
	if (!$result1){
	   die ("Could not query the media table in the database: <br />". mysql_error());
	}

	$num_row = mysql_num_rows($result1);
	if (!$num_row) {
        die ("No result found. <br />". mysql_error());
        Print '<script>window.location.assign("browse.php");</script>';
    }

	?>
	<div style="background:#339900;color:#FFFFFF; width:200px;">Matched Files</div>
	<table width="50%" cellpadding="0" cellspacing="0">
		<?php
			while ($result_row = mysql_fetch_row($result1)) //filename, username, type, mediaid, path
			{ 
				$mediaid = $result_row[3];
				$filename = $result_row[0];
				$filenpath = $result_row[4];
				$title=$result_row[6];
		?>
        	 <tr valign="top">			
                 <td>
                     <a href="media.php?id=<?php echo $mediaid;?>" target="_blank"><?php echo $title;?></a>
                 </td>
                 <td>
                     <a href="<?php echo $filenpath;?>" target="_blank" onclick="javascript:saveDownload(<?php echo $result_row[4];?>);">Download</a>
                 </td>
		    </tr>
        	<?php
			}
		?>
	</table>
   </div>
<?php
}	
?>

</body>
</html>
