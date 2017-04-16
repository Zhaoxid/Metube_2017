<!DOCTYPE HTML>
<?php
    session_start();
    include_once "function.php";

if(isset($_POST['submit'])) {
    $check = user_exist($_POST['user2']);

    if ($check == 2) {
        echo "<script type='text/javascript'>alert('Contact Added!')</script>";
        exit(-1);
    }

    $relationship = $_POST['relation'];
    $username = $_SESSION['username'];
    $user2 = $_POST['user2'];
    $query = "insert into contacts values ('$username', '$relationship', '$user2')";
    $result = mysql_query($query);
    if(!$result) die("error adding contact.".mysql_error());

    echo "<script type='text/javascript'>alert('Contact Added!')</script>";
}
?>

<html>
<head>
    <title> Contacts </title>
    <style>
        td, th {
            text-align: center;
            padding:4px;
        }
    </style>
</head>
<h1> <?php echo "Welcome,", $_SESSION['username'],"!" ?></h1>
<a href='browse.php'  style="color:#FF9900;">Return</a> <br><br>
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
<div style="background:#339900;color:#FFFFFF; width:200px;">Contacts List</div>
<table>
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