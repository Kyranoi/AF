<?php
    require 'db_config.php';
    //Update klant
    if (isset($_POST['naam'])) {
        $naam = $_POST['naam'];
        $code = $_POST['code'];
        $id = $_POST['id'];

        //COUNT(*) telt alle rows in reserveringen maar ik laat hem specefiek tellen waar tafel, datum en tijd user input hebben. Als deze alle 3 gelijk zijn en er meer dan 0 gelijke zijn geef dan een error.
        $error = pdo($pdo, "SELECT COUNT(*) as count FROM gerechtcategorien WHERE code = ?", [$code]);
        $result = $error->fetch();

        if($result['count'] > 0) {
            echo "Code bestaat al.";
        } else {
            pdo($pdo, "UPDATE gerechtcategorien SET naam = :naam, code = :code WHERE id = $id", ['naam' => $naam, 'code' => $code]);
            header('location: food_menu.php');
        }
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $result = pdo($pdo, "SELECT * FROM gerechtcategorien WHERE id = $id")->fetch();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klant aanpassen</title>
</head>
<body>
   <form action="" method="POST">
        <label>Naam:</label>
        <input type="text" name="naam" value="<?php echo $result['naam'];?>">
        <label>Code:</label>
        <input type="text" name="code" minlength="3" maxlength="3" value="<?php echo $result['code'];?>">
        <input type="hidden" name="id" value="<?php echo $result['id'];?>">
        <input type="submit" name="submit" value="submit">
   </form> 
</body>
</html>