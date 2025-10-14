<?php 
    //Step 1. Get database access
    require('../config/database.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketapp - List users</title>
</head>
<body>
    <table border = "1" align = "center">
        <tr>
            <tr>
            <th>Fullname</th>
            <th>E-mail</th>
            <th>Ide. number</th>
            <th>Phone number</th>
            <th>Status</th>
            <th>Options</th>
        </tr>
        <?php
            sql_users = "
                //
            ";
        ?>
        <tr>
            <td>Joe Doe</td>
            <td>joe@gmail.com</td>
            <td>2543654654</td>
            <td>4134436535</td>
            <td>Active</td>
            <td>
                <a href = "#">
                    <img src ="icons/search.png" width = "30">
                </a>
                <a href = "#">
                    <img src ="icons/update.png" width = "20">
                </a>
                <a href = "#">
                    <img src ="icons/delete.png" width = "20">
                </a>
            </td>
        </tr>
    </table>
</body>
</html>
