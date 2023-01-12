<?php

    require 'db_config.php';

    //Post klant
    if (isset($_POST['klant_naam']) && !empty($_POST['klant_naam'])) {
        $klant_naam = $_POST['klant_naam'];
        $klant_telefoon = $_POST['klant_telefoon'];
        $klant_email = $_POST['klant_email'];

        pdo($pdo, "INSERT INTO klanten VALUES (null, ?, ?, ?)", 
        [$klant_naam , $klant_telefoon, $klant_email]);
        header("location: klant.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team toevoegen</title>
</head>
    <body>
        <form action="" method="POST">
            <label>Naam:</label>
            <input type="text" name="klant_naam">   
            <label>Telefoonnummer:</label>
            <input type="text" name="klant_telefoon">
            <label>Email:</label>
            <input type="text" name="klant_email">
            <input type="submit" name="submit" value="submit">
        </form> 
    </body>
</html>