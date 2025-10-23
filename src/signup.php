<?php 
 //Step 1. Get database access
 require('../config/database.php');

 //Step 2. Get form-data
 $f_name      = trim($_POST['fname']);
 $l_name      = trim($_POST['lname']);
 $m_number    = trim($_POST['mnumber']);
 $id_number   = trim($_POST['idnumber']);
 $e_mail      = trim($_POST['email']);
 $p_wd        = trim($_POST['passwd']);

 //$enc_pass = password_hash($p_wd,PASSWORD_DEFAULT);
 $enc_pass = md5($p_wd);

 //validar datos 
 $check_email = "
    SELECT
        u.email
    FROM
        users u
    WHERE
        email = '$e_mail' or ide_number ='$id_number'
    LIMIT 1
    ";
    $query = "
        SELECT id, name FROM cities WHERE status = true
        ";
        $query2 = "
        SELECT id, name FROM cities WHERE status = true
        ";
        $cities = pg_query($conn_supa, $query);
        $cities2 = pg_query($conn_supa, $query2);
    
    $res_check = pg_query($conn_supa,$check_email);
    if(pg_num_rows($res_check)> 0){
        echo "<script>alert('User already exists !!')</script>";
        header('refresh:0;url=signup.html');
    } else{
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
    $res = pg_query($conn_supa,$query);

    //Step 5. Validate result 
    if($res){
        //echo "User has been created successfully !!!";
        echo "<script>alert('Success !!! Go to login')</script>";
        header('refresh:0;url=signin.html');
    }else{
        echo "Something wrong!";
    }
    }
    
?>
   <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market - Register</title>
    <link rel="icon" href="icons/market_main.png" type="image/png">
</head>
<body>
    <center><h1>Register Form</h1></center>
    <form name="register-form" action="signup1.php" method="post">
        <table align="center">
            <tr><td><label>Firstname:</label></td></tr>
            <tr><td><input type="text" name="fname" placeholder="Firstname" required></td></tr>
            <tr><td><label>Lastname:</label></td></tr>
            <tr><td><input type="text" name="lname" placeholder="Lastname" required></td></tr>
            <tr><td><label>Adress:</label></td></tr>
            <tr><td><input type="text" name="adress" placeholder="Adress" required></td></tr>
            <tr><td><label>Mobile number:</label></td></tr>
            <tr><td><input type="text" name="mnumber" placeholder="Mobile phone" required></td></tr>
            <tr><td><label>Identification number:</label></td></tr>
            <tr><td><input type="text" name="idenumber" placeholder="Identification number" required></td></tr>
            <tr><td><label>Email:</label></td></tr>
            <tr><td><input type="email" name="email" placeholder="Email" required></td></tr>
            <tr><td><label>Password:</label></td></tr>
            <tr><td><input type="password" name="passwd" placeholder="Password" required><br></td></tr>
            <tr><td><label>Birth city:</label></td></tr>
            <tr><td>
                <select name="id_city_birthday" required>
                    <?php while ($row = pg_fetch_assoc($cities)): ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['name']); ?></option>
                    <?php endwhile; ?>
                </select>    
            </td></tr>
            <tr><td><label>City document:</label></td></tr>
            <tr><td>
                <select name="id_city_document" required>
                    <?php while ($row = pg_fetch_assoc($cities2)): ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['name']); ?></option>
                    <?php endwhile; ?>
                </select>
            </td></tr>
            <!--<tr><td><button>Register</button></td></tr>-->
            <tr><td style="text-align:center;"><button style="background:#4CAF50;color:white;padding:10px 20px;border:none;border-radius:8px;cursor:pointer;">Register</button></td></tr>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
            <tr><td style="text-align:center;"><a href="#" style="color:#3b5998;font-size:24px; margin:0 8px;"><i class="fab fa-facebook-f"></i></a>
            <a href="mailto:tucorreo@gmail.com" style="color:#e71401;font-size:24px; margin:0 8px;"><i class="fab fa-google"></i></a>
            <a href="#" style="color:#333;font-size:24px; margin:0 8px;"><i class="fab fa-github"></i></a></td></tr>
            <tr><td><center><a href="signin.html" style="color:royalblue; text-decoration: underline;">I already have an account</a></center></td></tr>
        </table>
    </form>
</body>
</html>