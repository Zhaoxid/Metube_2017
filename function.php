<?php
include "mysqlClass.inc.php";

function user_exist_check ($username, $password){
	$query = "select * from account where username='$username'";
	$result = mysql_query( $query );
	if (!$result){
		die ("user_exist_check() failed. Could not query the database: <br />". mysql_error());
	}	
	else {
		$row = mysql_fetch_assoc($result);
		if($row == 0){
			$query = "insert into account values ('$username','$password')";
			echo "insert query:" . $query;
			$insert = mysql_query( $query );
			if($insert)
				return 1;
			else
				die ("Could not insert into the database: <br />". mysql_error());		
		}
		else{
			return 2;
		}
	}
}
function user_exist ($username)
{
    $query = "select * from account where username='$username'";
    $result = mysql_query($query);
    if (!$result) {
        die ("user_exist() failed. Could not query the database: <br />" . mysql_error());
    } else {
        $row = mysql_fetch_row($result);
        if (strcmp($row[0], $username))
            return 2;
        else
            return 0;
    }
}

function playlist_check ($playlistname, $username)
{
    $query = "select * from playlist_user where username='$username'";
    $result = mysql_query($query);
    if (!$result) {
        die ("playlist_check() failed. Could not query the database: <br />" . mysql_error());
    } else {
    	while ($row = mysql_fetch_row($result)) {
            if (!strcmp($row[0], $playlistname)) {
                return 2;
            }
        }
		return 0;
    }
}
function playlist_media_check ($playlistid, $username)
{
    $query = "select * from playlist_user where username='$username'";
    $result = mysql_query($query);
    if (!$result) {
        die ("playlist_check() failed. Could not query the database: <br />" . mysql_error());
    } else {
        while ($row = mysql_fetch_row($result)) {
            if (!strcmp($row[0], $playlistid)) {
                return 2;
            }
        }
        return 0;
    }
}
function user_pass_check($username, $password)
{
	
	$query = "select * from account where username='$username'";
	$result = mysql_query( $query );
		
	if (!$result)
	{
	   die ("user_pass_check() failed. Could not query the database: <br />". mysql_error());
	}
	else{
		$row = mysql_fetch_row($result);
		if(strcmp($row[1],$password))
			return 2; //wrong password
		else 
			return 0; //Checked.
	}	
}

function playlistid_check($playlistname, $username) {
    $query = "select * from playlist_user where username='$username' and playlistname ='$playlistname'";
    $result = mysql_query( $query );
	$row = mysql_fetch_row($result);
	return $row[2];
}
function updateMediaTime($mediaid)
{
	$query = "	update  media set lastaccesstime=NOW()
   						WHERE '$mediaid' = mediaid
					";
					 // Run the query created above on the database through the connection
    $result = mysql_query( $query );
	if (!$result)
	{
	   die ("updateMediaTime() failed. Could not query the database: <br />". mysql_error());
	}
}

function upload_error($result)
{
	//view erorr description in http://us2.php.net/manual/en/features.file-upload.errors.php
	switch ($result){
	case 1:
		return "UPLOAD_ERR_INI_SIZE";
	case 2:
		return "UPLOAD_ERR_FORM_SIZE";
	case 3:
		return "UPLOAD_ERR_PARTIAL";
	case 4:
		return "UPLOAD_ERR_NO_FILE";
	case 5:
		return "File has already been uploaded";
	case 6:
		return  "Failed to move file from temporary directory";
	case 7:
		return  "Upload file failed";
	}
}
/*
if (isset($_POST['action'])) {
	switch ($_POST['action']) {
		case 'Username':
			Username();
			break;
	}
} */

function Username($order)
{
	if ($order == "DESC") {
        	$query = "SELECT * from media ORDER BY username DESC";
	}
	else {
                $query = "SELECT * from media ORDER BY username ASC";
	}
        $result = mysql_query( $query );
        if (!$result){
           die ("Could not query the media table in the database: <br />".
                mysql_error());
        }
	
}


function Title($order)
{
	if ($order == "DESC"){
        	$query = "SELECT * from media ORDER BY title DESC";
	}
	else {
        	$query = "SELECT * from media ORDER BY title ASC";
	}
        $result = mysql_query( $query );
        if (!$result){
           die ("Could not query the media table in the database: <br />".
                mysql_error());
        }
	return $result;
}

function Views($order)
{
        if ($order == "DESC"){
                $query = "SELECT * from media ORDER BY views DESC";
        }
        else {
                $query = "SELECT * from media ORDER BY views ASC";
        }
        $result = mysql_query( $query );
        if (!$result){
           die ("Could not query the media table in the database: <br />".
                mysql_error());
        }
        return $result;
}


?>
