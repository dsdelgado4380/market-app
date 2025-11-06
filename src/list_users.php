<?php
//step 1. Get database connection
    require('../config/database.php');

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
    <title>Marketapp - List users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-3">
    <table align="center" class="table table-dark table-striped"> 
        <tr> 
        </tr>
        <tr>
           <th>Fullname</th>
           <th>E-mail</th>
           <th>Ide. number</th>
           <th>Phone number</th>
           <th>Status</th>
           <th>Options</th> 
        </tr>
        <?php
            $sql_users="
            select
            u.id as user_id,
            u.firstname  || ' ' || u.lastname as fullname,
            u.email,
            u.ide_number,
            u.mobile_number,
                case
                    when u.status = true then 'Active' else 'Inactive'
                end as status
            from 
                users u
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
                    <td>".$row['status'] ."</td>
                    <td>
                            <a href='#'>
                              <img src='icons/search1.png' width='30'>
                            </a>
                            <a href='edit_user_form.php?userId=".$row['user_id'] ."'>
                                <img src='icons/update2.png' width='30'>
                            </a>
                            <a href='delete_user.php?userId=".$row['user_id'] ."'>
                                <img src='icons/delete1.png' width='30'>
                            </a>
                    </td> 
              </tr>";
            }
        ?> 
           
    </table>  
    </div>  
</body>
</html>