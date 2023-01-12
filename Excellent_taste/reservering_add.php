<?php

    require 'db_config.php';

    //Post reservering
    if (isset($_POST['r_tafel']) && !empty($_POST['r_tafel'])) {
        $r_tafel = $_POST['r_tafel'];
        $r_datum = $_POST['r_datum'];
        $r_tijd = $_POST['r_tijd'];
        $r_klant_id = $_POST['r_klant_id'];
        $r_aantal = $_POST['r_aantal'];
        $r_status = $_POST['r_status'];
        $r_aantal_k = $_POST['r_aantal_k'];
        $r_allergien = $_POST['r_allergien'];
        $r_opmerkingen = $_POST['r_opmerkingen'];
        
        //COUNT(*) telt alle rows in reserveringen maar ik laat hem specefiek tellen waar tafel, datum en tijd user input hebben. Als deze alle 3 gelijk zijn en er meer dan 0 gelijke zijn geef dan een error.
        $error = pdo($pdo, "SELECT COUNT(*) as count FROM reserveringen WHERE tafel = ? AND datum = ? AND tijd = ?", [$r_tafel, $r_datum, $r_tijd]);
        $result = $error->fetch();

        if($result['count'] > 0) {
            echo "Tafel is al gereserveerd.";
        } else {
            pdo($pdo, "INSERT INTO reserveringen VALUES (null, ?, ?, ?, ?, ?, ?, NOW(),?,?,?)", 
            [$r_tafel, $r_datum, $r_tijd, $r_klant_id, $r_aantal, $r_status, $r_aantal_k, $r_allergien, $r_opmerkingen]);
            header("location: reservering.php");
        }
    }

    //Selecteer id en naam van klanten
    $stmt = pdo($pdo, "SELECT id, naam FROM klanten");
    $klanten = $stmt->fetchAll();

    // Select de namen met de value id
    $options = "";
    foreach ($klanten as $klant) {
        $options .= "<option value='" . $klant['id'] . "'>" . $klant['naam'] . "</option>";
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reservering toevoegen</title>
    </head>
        <body>
            <form action="" method="POST">
                <label>Tafel</label>
                <input type="number" name="r_tafel" min="1" max="20"><br>
                <label>Datum:</label>
                <input type="date" min="2023-01-01" max="2023-12-31"  name="r_datum"><br>
                <label>Tijd:</label>
                <input type="time" min="17:00" max="22:00"  name="r_tijd"><br>
                <label>Klant:</label>
                <select name="r_klant_id">
                <?php echo $options; ?>
                </select><br>
                <label>Aantal:</label>
                <input type="number" name="r_aantal" min="1"><br>
                <label>Status:</label>
                <input type="number" name="r_status" min="1"><br>
                <label>Kinderen:</label>
                <input type="number" name="r_aantal_k" min="0"><br>
                <label>Allergien:</label>
                <input type="text" name="r_allergien"><br>
                <label>Opmerkingen:</label>
                <input type="text" name="r_opmerkingen"><br>
                <input type="submit" name="submit" value="submit">
            </form>
        </body>
</html>