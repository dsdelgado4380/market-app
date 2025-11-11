<?php
    //step 1. Get database connection
    require('../config/database.php');
    //Step 2. Get data or params
    $user_id = $_GET['userId'];

    $sql_get_user = "select * from users where id = $user_id";
    $result = pg_query($conn_local , $sql_get_user);

    if(!$result){
        die("error:". pg_last_error());
    }
    while($row = pg_fetch_assoc($result)){
        $ide_number = $row['ide_number'];
        $fname = $row['firstname'];
        $lname = $row['lastname'];
    }   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center><form name = "edit-user-form" action = "update_user.php" method= "post">
        <input 
            type = "hidden" 
            name = "iduser" 
            value ="<?php echo $user_id ?>"
            readonly
            required /><br><br>
        <label>Identification number:</label>
        <input 
            type = "text" 
            name = "idenumber" 
            value ="<?php echo $ide_number ?>"
            readonly
            required /><br><br>
        <label>Firstname:</label>
        <input 
            type = "text" 
            name = "fname" 
            value ="<?php echo $fname ?>"
            required /><br><br>
        <label>Lastname:</label>
        <input 
            type = "text" 
            name = "lname" 
            value ="<?php echo $lname ?>"
            required /><br><br>
        <label>User Photo</label><br>
        <input 
            type="file" 
            name="photo_user">
            <br><br>
        <tr><td style="text-align:center;"><button style="background:#4CAF50;color:white;padding:10px 20px;border:none;border-radius:8px;cursor:pointer;">Update user</button></td></tr>
        
</form>
</body>
</html>