<?php

    require 'db_config.php';

    //Post klant
    if (isset($_POST['drank_code']) && !empty($_POST['drank_code'])) {
        $drank_item = $_POST['drank_item'];
        $drank_code = $_POST['drank_code'];
        $dranksoort_prijs = $_POST['drank_prijs'];
        $dranksoort_id = $_POST['dranksoort_id'];
         //COUNT(*) telt alle rows in reserveringen maar ik laat hem specefiek tellen waar tafel, datum en tijd user input hebben. Als deze alle 3 gelijk zijn en er meer dan 0 gelijke zijn geef dan een error.
         $error = pdo($pdo, "SELECT COUNT(*) as count FROM menuitems WHERE code = ?", [$drank_code]);
         $result = $error->fetch();

        if($result['count'] > 0) {
            echo "Code bestaat al.";
        } else {
            pdo($pdo, "INSERT INTO menuitems VALUES (null, ?, ?, ?, ?)", [$drank_item , $drank_code, $dranksoort_prijs, $dranksoort_id]);
            header("location: dranken.php");
         }
    }

    //Selecteer id en naam van klanten
    $stmt = pdo($pdo, "SELECT id, naam FROM gerechtsoorten WHERE gerechtsoorten.gerechtcategorie_id = 4");
    $dranken = $stmt->fetchAll();

    // Select de namen met de value id
    $options = "";
    foreach ($dranken as $drank) {
        $options .= "<option value='" . $drank['id'] . "'>" . $drank['naam'] . "</option>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dranken toevoegen</title>
</head>
    <body>
        <form action="" method="POST">
            <label>Drank code:</label>
            <input type="text" minlength="4" maxlength="4" name="drank_code">   
            <label>Drank naam:</label>
            <input type="text" name="drank_item">
            <label>Drank</label>
                <select name="dranksoort_id">
                <?php echo $options; ?>
                </select><br>
            <label>Prijs:</label>
            <input type="text" name="drank_prijs">
            <input type="submit" name="submit" value="submit">
        </form> 
    </body>
</html>