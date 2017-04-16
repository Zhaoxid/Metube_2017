<!DOCTYPE HTML>
<?php
session_start();
include_once "function.php";

?>
<html>
<head>

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
<p class="bold">Welcome to metube, <?php echo $_SESSION['username'];?>!</p>

<?php
    $user = $_SESSION['username'];
    $query = "SELECT * from message where rcvusername = '$user' order by ts DESC";
    $result = mysql_query( $query );
    if (!$result){
        die ("Could not query the message table in the database: <br />". mysql_error());
    }
?>

<body>
<a href='browse.php'  style="color:#FF9900;">Return</a> <br><br>

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


