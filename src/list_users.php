<?php
//s
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
    <table border="1" align="center">
        <tr> 
        </tr>
        <tr>
           <th>Fullname</th>
           <th>E-mail</th>
           <th>ide. number</th>
           <th>Phone number</th>
           <th>Status</th>
           <th>Options</th> 
        </tr>
        <?php
            $sql_users="
            select u.firstname  || ' ' || u.lastname as fullname,
            u.email,
            u.ide_number,
            u.mobile_number,
                case
                    when u.status = true then 'Active' else 'Inactive'
                end
            from 
                users as u
            ";   
            $result = pg_query($conn_local, $sql_users);
            if(!$result){
                die("error:". pg_last_error());
            }    
            while ($row=pg_fetch_assoc($result)){
             echo"
                <tr>
                    <td>".$row['fullname'] ."</td>
                    <td>".$row['email'] ."</td>
                    <td>".$row['ide_number'] ."</td>
                    <td>".$row['mobile_number'] ."</td>
                    <td>active</td>
                    <td>
                            <a href='#'>
                              <img src='icons/search.png' width='30'>
                            </a>
                            <a href='#'>
                                <img src='icons/update.png' width='30'>
                            </a>
                            <a href='#'>
                                <img src='icons/delete.png' width='30'>
                            </a>
                    </td> 
              </tr>";
            }
        ?> 
           
    </table>    
</body>
</html>