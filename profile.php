<!DOCTYPE html>
<?php
session_start();
include_once "function.php";
if(isset($_POST['submit'])) {
    $deleteMedia = "delete from media where mediaid='".$_GET['id']."'";
    $result = mysql_query($deleteMedia);
    if (!$result) {
        echo "delete error";
    }
}
?>
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
    <title> Profile </title>


    <script type="text/javascript">
        function deleteMedia(id)
        {
            $.post("media_delete_process.php",
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
<p class="bold">Welcome to metube, <?php echo $_SESSION['username'];?>!</p></br>
<a href='update_profile.php'  style="color:#FF9900;">Update Profile</a> <br><br>
<?php
$user = $_SESSION['username'];
$query = "SELECT * from media where username = '$user'";
$result = mysql_query( $query );
if (!$result){
    die ("Could not query the media table in the database: <br />". mysql_error());
}
?>
<div style="background:#339900;color:#FFFFFF; width:200px;">Media Upload List</div>
<table>
    <col width="30">
    <col width="100">
    <col width="100">

    <tr>
        <th> Title </th>
        <th> Description </th>
        <th> Option </th>
    </tr>
    <?php
    while ($result_row = mysql_fetch_row($result)) {
        ?>
        <tr>
            <td> <?php echo $result_row[6];?></td>
            <td> <?php echo $result_row[5];?></td>
            <td>
                <form action="media_delete_process.php?id=<?php echo $result_row[3];?>" method="POST">
                <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
        <?php
    }
    ?>
</table>

</body>
</br></br>
<a href="browse.php">[Go Back]</a>
</html>