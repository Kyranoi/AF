<?php

    require 'db_config.php';

    //Post klant
    if (isset($_POST['gerecht_code']) && !empty($_POST['gerecht_code'])) {
        $gerecht_item = $_POST['gerecht_item'];
        $gerecht_code = $_POST['gerecht_code'];
        $gerechtsoort_id = $_POST['gerechtsoort_id'];
        $gerechtsoort_prijs = $_POST['gerechtsoort_prijs'];

         //COUNT(*) telt alle rows in reserveringen maar ik laat hem specefiek tellen waar tafel, datum en tijd user input hebben. Als deze alle 3 gelijk zijn en er meer dan 0 gelijke zijn geef dan een error.
         $error = pdo($pdo, "SELECT COUNT(*) as count FROM menuitems WHERE code = ?", [$gerecht_code]);
         $result = $error->fetch();

        if($result['count'] > 0) {
            echo "Code bestaat al.";
        } else {
            pdo($pdo, "INSERT INTO menuitems VALUES (null, ?, ?, ?, ?)", [$gerecht_item , $gerecht_code, $gerechtsoort_id, $gerechtsoort_prijs]);
            header("location: gerechten.php");
         }
    }

    //Selecteer id en naam van klanten
    $stmt = pdo($pdo, "SELECT id, naam FROM gerechtsoorten WHERE gerechtsoorten.gerechtcategorie_id != 4");
    $gerechten = $stmt->fetchAll();

    // Select de namen met de value id
    $options = "";
    foreach ($gerechten as $gerecht) {
        $options .= "<option value='" . $gerecht['id'] . "'>" . $gerecht['naam'] . "</option>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gerechten toevoegen</title>
</head>
    <body>
        <form action="" method="POST">
            <label>gerecht code:</label>
            <input type="text" minlength="4" maxlength="4" name="gerecht_code">   
            <label>gerecht naam:</label>
            <input type="text" name="gerecht_item">
            <label>Gerechtsoort</label>
                <select name="gerechtsoort_id">
                <?php echo $options; ?>
                </select><br>
            <label>Prijs:</label>
            <input type="text" name="gerecht_prijs">
            <input type="submit" name="submit" value="submit">
        </form> 
    </body>
</html>