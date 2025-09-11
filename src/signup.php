<?php 
 //Step 1. Get database access
 require('../config/database.php');

 //Step 2. Get form-data
 $f_name      = $_POST['fname'];
 $l_name      = $_POST['lname'];
 $m_number    = $_POST['mnumber'];
 $id_number   = $_POST['idnumber'];
 $e_mail      = $_POST['email'];
 $p_wd        = $_POST['passwd'];

 $enc_pass = password_hash($p_wd,PASSWORD_DEFAULT);

 //Step 3. Create query to INSERT INTO 
 $query ="
     INSERT INTO users (
         firstname,
         lastname,
         mobile_number,
         ide_number,
         email,
         password
     ) VALUES (
     '$f_name',
     '$l_name',
     '$m_number',
     '$id_number',
     '$e_mail',
     '$enc_pass'
    )
";

 //Step 4. Execute query
 $res=pg_query($conn,$query);

 //Step 5. Validate result 
 if($res){
    echo "User has been created successfully !!!";
 }else{
    echo "Something wrong!";
 }


?>