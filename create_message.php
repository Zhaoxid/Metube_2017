<title>Create Message</title>
</head>
<body>
<div align="center">
    <?php
    if(isset($_GET['id'])) {
        echo "Send message to ", $_GET['id']; ?>
        <form action="send_message.php?id=<?php echo $_GET['id'];?>" method="POST">
        <input type="text" size="40" name="subj" placeholder="Enter a Subject" required><br />
        <textarea name="msg" cols="80" rows="8" placeholder="Type the message" required></textarea><br/>
        <input type="submit" value="Send">
        </form>
    <?php } else { ?>
    <form action="send_message.php" method="POST">
        <input type="text" size="40" name="rcvusername" placeholder="Enter the receiver username" required><br/>
        <input type="text" size="40" name="subj" placeholder="Enter a Subject" required><br />
        <textarea name="msg" cols="80" rows="8" placeholder="Type the message" required></textarea><br/>
        <input type="submit" value="Send">
    </form>
    <?php } ?>
</div>
</body>
</html>