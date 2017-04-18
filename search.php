<?php
	session_start();
	include_once "function.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media Search</title>
<link rel="stylesheet" type="text/css" href="css/default.css" />
<script type="text/javascript" src="js/jquery-latest.pack.js"></script>
<script type="text/javascript">
</script>
</head>

<body>

<p>Welcome <?php echo $_SESSION['username'];?> <a href="javascript:history.back();">[Go Back]</a> </p>

<?php
if(isset($_GET['search'])){
	$query1= "SELECT * FROM media WHERE title='".$_GET['search']."' OR username='".$_GET['search']."'";
	//$querry2= "SELECT * FROM tags WHERE tag='".$_GET['search']."'";
	
	$result1 = mysql_query($query1);
	if (!$result1){
	   die ("Could not query the media table in the database: <br />". mysql_error());
	}
	//$result2 = mysql_query($query2);
	//if (!$result2){
	//   die ("Could not query the media table in the database: <br />". mysql_error());
	//}
	
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
