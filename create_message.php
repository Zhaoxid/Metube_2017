<title>Create Message</title>
</head>
<body>
<div align="center">
    <form action="send_message.php" method="POST">
        <input type="text" size="40" name="rcvusername" placeholder="Enter the receiver username"><br/>
        <input type="text" size="40" name="subj" placeholder="Enter a Subject"><br />
        <textarea name="msg" cols="80" rows="8" placeholder="Type the message"></textarea><br/>
        <input type="submit" value="Send">
    </form>
</div>
</body>
</html>