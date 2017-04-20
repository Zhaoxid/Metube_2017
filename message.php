<!DOCTYPE HTML>
<?php
session_start();
include_once "function.php";
if(empty($_SESSION['username'])){
    Print '<script>alert("User not found");</script>';
    Print '<script>window.location.assign("index.php");</script>';
}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/default.css" />

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

    <style>
        button {
            background-color: #778899;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 13px;
            margin: 2px 1px;
            cursor: pointer;
        }

        p.bold {
            font-family: arial, sans-serif;
            font-size: 20px;
            color: black;
            font-weight = bold;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
    <title> Send Message </title>
</head>

<?php
    $user = $_SESSION['username'];
    $query = "SELECT * from message where rcvusername = '$user' order by ts DESC";
    $result = mysql_query( $query );
    if (!$result){
        die ("Could not query the message table in the database: <br />". mysql_error());
    }
?>

<body>

<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:250px">

  <div class="w3-row w3-padding-64">
    <div class="w3-twothird w3-container">
      <h1 class="w3-text-teal">Inbox</h1>

<button onclick="window.open('create_message.php', 'newwindow', 'width=700, height=350, top=300, left = 450' ); ">Create New Message</button>
<br><br>
<h3><?php echo $_SESSION['username']; ?>'s Inbox</h3>
<table>
    <col width="100">
    <col width="135">
    <col width="250">
    <col width="530">

    <tr>
        <th> Sender </th>
        <th> Time Sent</th>
        <th> Subject </th>
        <th> Message </th>
    </tr>
    <?php
        while ($result_row = mysql_fetch_row($result)) {
        $sduser = $result_row[2];
        $message = $result_row[0];
        $subject = $result_row[1];
     ?>
    <tr>
        <td> <?php echo $sduser;?></td>
        <td> <?php echo $result_row[5];?></td>
        <td> <?php echo $subject;?></td>
        <td> <?php echo $message;?></td>
    </tr>

    <?php
    }
?>
</table>


</body>
</html>


