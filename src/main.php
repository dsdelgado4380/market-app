<?php
    session_start();

    if(!isset($_SESSION['session_user_id'])){
        header('refresh:0;url=error_403.html');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketapp - Home</title>
    <link rel="icon"type="image/png" href="icons/market_main1.png" />
</head>
<body>
    <center><b>User: </b>
    <?php echo $_SESSION['session_user_fullname']; ?></center>
    <a href = "list_users.php">List all users</a> ||
    <a href = "logout.php">Logout</a>
</body>
</html>