<?php

    require 'db_config.php';

    //Post klant
    if (isset($_POST['menu_code']) && !empty($_POST['menu_code'])) {
        $menu_code = $_POST['menu_code'];
        $menu_naam = $_POST['menu_naam'];

         //COUNT(*) telt alle rows in reserveringen maar ik laat hem specefiek tellen waar tafel, datum en tijd user input hebben. Als deze alle 3 gelijk zijn en er meer dan 0 gelijke zijn geef dan een error.
         $error = pdo($pdo, "SELECT COUNT(*) as count FROM gerechtcategorien WHERE code = ?", [$menu_code]);
         $result = $error->fetch();
 
         if($result['count'] > 0) {
             echo "Code bestaat al.";
         } else {
            pdo($pdo, "INSERT INTO gerechtcategorien VALUES (null, ?, ?)", [$menu_code , $menu_naam]);
            header("location: food_menu.php");
         }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu's toevoegen</title>
</head>
    <body>
        <form action="" method="POST">
            <label>Menu code:</label>
            <input type="text" minlength="3" maxlength="3" name="menu_code">   
            <label>Menu naam:</label>
            <input type="text" name="menu_naam">
            <input type="submit" name="submit" value="submit">
        </form> 
    </body>
</html>