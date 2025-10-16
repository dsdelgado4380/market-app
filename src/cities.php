<?php
// Step 1: get database access
require('../config/database.php');

// Step 2: If form submitted, process insert
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $abbrev = trim($_POST['abbrev']);
    $code = trim($_POST['code']);
    $status_input = trim($_POST['status']);
    $id_region = trim($_POST['id_region']); // valor del combo box

    // Convertir status string a boolean para la DB
    $status = ($status_input === 'active') ? 'TRUE' : 'FALSE';

    // Validar duplicados
    $check_city = "
        SELECT name FROM cities
        WHERE name = '$name' AND id_region = '$id_region'
        LIMIT 1
    ";
    $res_check = pg_query($conn_supa, $check_city);

    if ($res_check && pg_num_rows($res_check) > 0) {
        echo "<script>alert('⚠️ City already exists in this region');</script>";
        header('refresh:0; url=cities.php');
        exit;
    }

    // Insertar nueva ciudad
    $query = "
        INSERT INTO cities (name, abbrev, code, status, id_region)
        VALUES ('$name', '$abbrev', '$code', $status, '$id_region')
    ";

    $res = pg_query($conn_supa, $query);

    if ($res) {
        echo "<script>alert('✅ City registered successfully');</script>";
        header('refresh:0; url=cities.php');
        exit;
    } else {
        echo "❌ Something went wrong: " . pg_last_error($conn_supa);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Register City</title>
</head>
<body bgcolor="#C1DBD8">
    <center><h1>Register City</h1></center>
    <form action="cities.php" method="post">
        <table border="0" align="center">
            <tr><td><label>Name:</label></td></tr>
            <tr><td><input type="text" name="name" placeholder="Name" required></td></tr>

            <tr><td><label>Abbrev:</label></td></tr>
            <tr><td><input type="text" name="abbrev" placeholder="Abbreviation" required></td></tr>

            <tr><td><label>Code:</label></td></tr>
            <tr><td><input type="text" name="code" placeholder="Code" required></td></tr>

            <tr><td><label>Status:</label></td></tr>
            <tr><td>
                <select name="status" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </td></tr>

            <tr><td><label>Region:</label></td></tr>
            <tr><td>
                <select name="id_region" required>
                    <option value="">Select a Region</option>
                    <?php
                    // Cargar regiones para el combo box
                    $sql = "SELECT id, name FROM regions ORDER BY name ASC";
                    $res = pg_query($conn_supa, $sql);
                    if ($res && pg_num_rows($res) > 0) {
                        while ($row = pg_fetch_assoc($res)) {
                            echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['name']) . "</option>";
                        }
                    } else {
                        echo "<option value=''>No regions found</option>";
                    }
                    ?>
                </select>
            </td></tr>

            <tr><td style="text-align:center;">
                <button style="background-color:blue; color:white; padding:10px 20px; border:none; cursor:pointer;">
                    Register City
                </button>
            </td></tr>
        </table>
    </form>
</body>
</html>
