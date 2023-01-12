<?php

    require 'db_config.php';

    //Post bestelling
    if (isset($_POST['b_r_id']) && !empty($_POST['b_r_id'])) {
        $b_r_id = $_POST['b_r_id'];
        $b_m_id = $_POST['b_m_id'];
        $b_aantal = $_POST['b_aantal'];
        $b_gereserveerd = $_POST['b_gereserveerd'];
        
        pdo($pdo, "INSERT INTO bestellingen VALUES (null, ?, ?, ?, ?)", 
        [$b_r_id, $b_m_id, $b_aantal, $b_gereserveerd]);
        header("location: bestelling.php");
    }

    //Selecteer id en item van menuitems
    $stmt = pdo($pdo, "SELECT id, item FROM menuitems");
    $bestel = $stmt->fetchAll();

    $stmt = pdo($pdo, "SELECT id, naam FROM klanten");
    $naam = $stmt->fetchAll();

    // Select de namen met de value id
    $options = "";
    foreach ($bestel as $bestelling) {
        $options .= "<option value='" . $bestelling['id'] . "'>" . $bestelling['item'] . "</option>";
    }

    $options2 = "";
    foreach ($naam as $namen) {
        $options2 .= "<option value='" . $namen['id'] . "'>" . $namen['naam'] . "</option>";
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bestelling toevoegen</title>
    </head>
        <body>
            <form action="" method="POST">
            <label>Naam:</label>
                <select name="b_r_id">
                <?php echo $options2; ?>
                </select><br>
                <label>Artikel:</label>
                <select name="b_m_id">
                <?php echo $options; ?>
                </select><br>
                <label>Aantal:</label>
                <input type="number" min="1" max="10" name="b_aantal"><br>
                <label>Gereserveerd:</label>
                <input type="number" min="0" max="10" name="b_gereserveerd"><br>
                <input type="submit" name="submit" value="submit">
            </form>
        </body>
</html>