<!DOCTYPE HTML>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/default.css" />

<?php
    session_start();
    include_once "function.php";

if(isset($_POST['submit'])) {
    $check = user_exist($_POST['user2']);

    if ($check == 2) {
        echo "<script type='text/javascript'>alert('Contact does not exist!')</script>";
    }

    else {
        $relationship = $_POST['relation'];
        $username = $_SESSION['username'];
        $user2 = $_POST['user2'];
        $query = "insert into contacts values ('$username', '$relationship', '$user2')";
        $result = mysql_query($query);
        if (!$result) die("error adding contact." . mysql_error());

        echo "<script type='text/javascript'>alert('Contact Added!')</script>";
    }
}
?>

<html>
<head>
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


<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:250px">

  <div class="w3-row w3-padding-64">
    <div class="w3-twothird w3-container">
      <h1 class="w3-text-teal">Contacts</h1>



    <title> Contacts </title>
    <style>
        td, th {
            text-align: center;
            padding:4px;
        }
    </style>
</head>
<body>
<form action="contacts.php" method="post" >
    Add Contacts: <input type="username2" name = "user2" required></input><br/>
    <input type = "radio" name = "relation" value = "friend"> Friend
    <input type = "radio" name = "relation" value = "family"> Family
    <input type = "radio" name = "relation" value = "favorite"> Favorite
    <input type = "radio" name = "relation" value = "other"> Other
    <input value="Add" name="submit" type="submit"/><br/><br/>
</form>
<?php
$user = $_SESSION['username'];
$query = "SELECT * from contacts where username1 = '$user'";
$result = mysql_query( $query );
if (!$result){
    die ("Could not query the media table in the database: <br />". mysql_error());
}
?>
<!-- <div style="background:#339900;color:#FFFFFF; margin-left:250px; width:200px;">Contacts List</div> -->
    <col width="30">
    <col width="100">
    <col width="100">

    <tr>
        <th> </th>
        <th> Username</th>
        <th> Relation </th>
    </tr>
    <?php
    $id = 0;
    while ($result_row = mysql_fetch_row($result)) {
        $id++;
        ?>
        <tr>
            <td> <?php echo $id, ".";?></td>
            <td> <?php echo $result_row[2];?></td>
            <td> <?php echo $result_row[1];?></td>
            <td> <button onclick="window.open('create_message.php?id=<?php echo $result_row[2];?>', 'newwindow',
            'width=700, height=350, top=300, left = 450' ); ">Message</button> </td>

        </tr>
        <?php
    }
    ?>
</table>

</body>



</html>
