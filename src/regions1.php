<?php
    //get database acces
    require('../config/database.php');

    //get form data
    $name = trim($_POST['name']);
    $abbrev = trim($_POST['abbrev']);
    $code = trim($_POST['code']);
    $country_id = trim($_POST['country_id']);

    $query = "
        INSERT INTO regions (
            name, 
            abbrev, 
            code,
            country_id
        ) VALUES (
            '$name', '$abbrev', '$code', '$country_id'
        )
        ";
        //execute query
        $res = pg_query($conn_supa, $query);
        //validate result
        if($res){
            //echo "Users has been created sucessfully!!!";
             echo "<center><h3 style='color:green;'> Region registered success!!!</h3></center>";
        } else {
            echo "Something wrong!";
        }
?>